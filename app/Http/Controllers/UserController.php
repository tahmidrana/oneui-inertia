<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\FileUploadService;
use App\Models\District;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
        view()->share('main_menu', 'users');
    }

    public function index()
    {
        view()->share('sub_menu', 'manage users');
        return view('users.index');
    }

    public function create()
    {
        abort_unless(auth()->user()->can('user-create'), Response::HTTP_UNAUTHORIZED);
        view()->share('sub_menu', 'add new user');
        return view('users.create', [
            'user_types' => Role::where('slug', '!=', 'clinician')->active()->get(),
            'districts' => District::all()
        ]);
    }

    public function store(UserPostRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make(env('USER_DEFAULT_PASSWORD'));

        try {
            $filePath = null;
            if (request()->has('photo')) {
                $filePath = $this->fileUploadService->uploadImage('photo', 'users');
            }

            $data['dob'] = $data['dob'] ? Carbon::parse($data['dob'])->format('Y-m-d') : null;
            $data['joining_date'] = $data['joining_date']
                ? Carbon::parse($data['joining_date'])->format('Y-m-d')
                : null;
            $data['photo'] = $filePath;
            DB::beginTransaction();
            $user = User::create($data);
            $userRoles[] = [
                'user_id' => $user->id,
                'role_id' => $request->user_type_id,
                'is_primary' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ];

            if ($request->other_roles_id) {
                $other_roles = collect($request->other_roles_id);

                $other_roles = $other_roles->filter(function ($value) {
                    return $value != request()->user_type_id;
                });

                foreach ($other_roles as $other_role) {
                    $userRoles[] = [
                        'user_id' => $user->id,
                        'role_id' => $other_role,
                        'is_primary' => 0,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }

            DB::table('role_user')->insert($userRoles);

            DB::commit();
            return redirect()->route('users.index')->withSuccess('User created successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput($request->all());
        }
    }

    public function edit(User $user)
    {
        abort_unless(auth()->user()->can('user-update'), Response::HTTP_UNAUTHORIZED);

        view()->share('sub_menu', 'manage users');
        return view('users.update', [
            'user' => $user,
            'districts' => District::all()
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();

        try {
            if (request()->has('photo')) {
                $filePath = $this->fileUploadService->uploadImage('photo', 'users');
                $data['photo'] = $filePath;
            }

            $data['dob'] = $data['dob'] ? Carbon::parse($data['dob'])->format('Y-m-d') : null;
            $data['joining_date'] = $data['joining_date']
                ? Carbon::parse($data['joining_date'])->format('Y-m-d')
                : null;

            User::where('id', $user->id)->update($data);

            return redirect()->route('users.index')->withSuccess('User updated successfully');
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput($request->all());
        }
    }

    public function show(User $user)
    {
        abort_unless(auth()->user()->can('user-view'), Response::HTTP_UNAUTHORIZED);
        view()->share('sub_menu', 'manage users');
        $user->load(['district', 'roles']);
        return view('users.show', compact('user'));
    }

    public function getUsers()
    {
        // Permissions
        $canEdit = auth()->user()->can('user-update');
        $canView = auth()->user()->can('user-view');
        $canActivation = auth()->user()->can('user-activation');
        // $canPasswordReset = auth()->user()->can('user-password-reset');

        $status = request()->has('is_active') ? request()->is_active : 1;
        $users = User::query()
            ->select(['id', 'name', 'userid', 'photo', 'last_login', 'joining_date', 'is_active'])
            ->with([
                'roles' => function ($q) {
                    $q->where('is_primary', 1)
                        ->select('roles.id', 'roles.title');
                }
            ])
            ->where('is_active', $status)
            ->where('is_clinician', 0)
            ->when(request()->has('is_active'), function ($q) {
                return $q->where('is_active', request()->is_active);
            })
            ->staff();

        $result = DataTables::of($users)
            ->addIndexColumn()
            ->editColumn('photo', function ($row) {
                if ($row->user_photo) {
                    return "<img src='{$row->user_photo}' class='img-avatar img-avatar48' alt='Client Photo' />";
                }
                $firstChar = mb_substr($row->name, 0, 1, "UTF-8");
                return "<p class='profile-icon bg-info'>{$firstChar}</p>";
            })
            ->editColumn('name', function ($row) {
                return '<p class="font-w600 mb-0">
                            <a href="'. route('users.show', ['user'=> $row->id]) .'">'. mb_substr($row->name, 0) .'</a>
                        </p>
                        <small class="text-muted mb-0">#'. $row->userid .'</small>';
            })
            ->addColumn('user_type', function ($row) {
                return $row->roles->count() ? $row->roles[0]->title : '-';
            })
            ->editColumn('last_login', function ($row) {
                return $row->last_login ? $row->last_login->format('d M Y h:i a') : '-';
            })
            ->editColumn('joining_date', function ($row) {
                return $row->joining_date ? $row->joining_date->format('d M Y') : '-';
            })
            ->addColumn('status', function ($row) {
                return $row->status;
            })
            ->addColumn('action', function ($row) use ($canView, $canEdit, $canActivation) {
                $btn = '';

                if ($canView) {
                    $btn .= '<a href="'. route('users.show', ['user'=> $row->id]) .'"
                        class="btn btn-sm btn-alt-info mr-1"
                        title="View"><i class="fa fa-fw fa-eye"></i></a>';
                }

                if ($canEdit) {
                    $btn .= '<a href="'. route('users.edit', ['user'=> $row->id]) .'"
                        class="btn btn-sm btn-alt-info mr-1"
                        title="Edit"><i class="fa fa-fw fa-pen"></i></a>';
                }

                if ($canActivation) {
                    if ($row->is_active) {
                        $btn .= '<a href="'. route('users.deactivate', ['user'=> $row->id]) .'"
                            onClick="return confirmDeactivate()"
                            class="btn btn-sm btn-alt-info mr-1"
                            title="Deactivate"><i class="fa fa-fw fa-user-lock"></i></a>';
                    } else {
                        $btn .= '<a href="'. route('users.activate', ['user'=> $row->id]) .'"
                            onClick="return confirmActivate()"
                            class="btn btn-sm btn-alt-info mr-1"
                            title="Activate"><i class="fa fa-fw fa-user-check"></i></a>';
                    }
                }

                /* if ($canPasswordReset) {
                    $btn .= '<a href="'. route('users.password-reset', ['user'=> $row->id]) .'"
                        onClick="return confirmPasswordReset()"
                        class="btn btn-sm btn-alt-info"
                        title="Password Reset"><i class="fa fa-fw fa-fingerprint"></i></a>';
                } */
                return $btn;
            })
            ->rawColumns(['action', 'name', 'photo', 'status'])
            ->make(true);
        return $result;
    }

    public function passwordReset(User $user)
    {
        abort_unless(auth()->user()->can('user-password-reset'), Response::HTTP_UNAUTHORIZED);
        try {
            $user->password = Hash::make(env('USER_DEFAULT_PASSWORD'));
            $user->save();
            return back()->withSuccess('User password reset success');
        } catch (Exception $e) {
            return back()->withError('User password reset failed');
        }
    }

    public function activate(User $user)
    {
        abort_unless(auth()->user()->can('user-activation'), Response::HTTP_UNAUTHORIZED);
        try {
            $user->is_active = 1;
            $user->save();
            return back()->withSuccess('User activated successfully');
        } catch (Exception $e) {
            return back()->withError('User activation failed');
        }
    }

    public function deactivate(User $user)
    {
        abort_unless(auth()->user()->can('user-activation'), Response::HTTP_UNAUTHORIZED);
        try {
            $user->is_active = 0;
            $user->save();
            return back()->withSuccess('User deactivated successfully');
        } catch (Exception $e) {
            return back()->withError('User deactivation failed');
        }
    }

    public function setUserType($user_type)
    {
        session(['role_id' => $user_type]);
        session(['role' => Role::find($user_type)]);

        $user_id = auth()->id();
        Cache::forget("menus_{$user_id}");
        Cache::forget("user_permissions_{$user_id}");

        return redirect()->route('dashboard.index')->withSuccess('Your current user type updated');
    }
}
