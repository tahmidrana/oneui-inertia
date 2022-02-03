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
        return inertia('Users/Index');
    }

    public function create()
    {
        abort_unless(auth()->user()->can('user-create'), Response::HTTP_UNAUTHORIZED);
        view()->share('sub_menu', 'add new user');

        return inertia('Users/Create', [
            'user_types' => Role::where('slug', '!=', 'clinician')->active()->get(),
        ]);
    }

    public function store(UserPostRequest $request)
    {
        $data = $request->validated();
        // dd($data);
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

        $limit = request()->limit ?? 10;
        $orderByCol = request()->orderBy ?? 'id';
        $orderByDir = request()->ascending && request()->ascending == 1 ? 'asc' : 'desc';

        $users = User::query()
            // ->select(['id', 'name', 'userid', 'photo', 'last_login', 'joining_date', 'is_active'])
            /* ->with([
                'roles' => function ($q) {
                    $q->where('is_primary', 1)
                        ->select('roles.id', 'roles.title');
                }
            ]) */
            ->when(request()->is_active, function ($q) {
                return $q->where('is_active', request()->is_active);
            })
            ->when(request()->searchKey, function ($q) {
                $search = request()->searchKey;
                // $q->where('name', $search);
                return $q
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('userid', 'like', "%{$search}%");
            })
            ->staff()
            ->orderBy($orderByCol, $orderByDir)
            // ->simplePaginate(5);
            ->paginate($limit);
        return $users;
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
