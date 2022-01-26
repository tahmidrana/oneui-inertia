<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserBulkUploadController extends Controller
{
    public function __construct()
    {
        view()->share('main_menu', 'users');
        view()->share('sub_menu', 'manage users');
    }

    public function index()
    {
        $user = auth()->user();
        abort_unless($user->is_superuser, 401);

        return view('user_bulk_upload.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_bulk_excel' => 'required|mimes:xlsx'
        ]);
        $user = auth()->user();
        abort_unless($user->is_superuser, 401);

        try {
            $importedExcel = Excel::toArray(new UsersImport, $request->file('user_bulk_excel'));
            throw_unless($importedExcel, new Exception('Invalid excel data'));

            $preparedData = [];
            $failedData = [];

            $excelData = $importedExcel[0];

            $password = Hash::make(env('USER_DEFAULT_PASSWORD'));

            foreach ($excelData as $row) {
                if ($row[0] && $row[2] && $row[3] && $row[4] && $row[5] && $row[6] && $row[11] && $row[13] && $row[14]) {
                    $user = [
                        'userid' => $row[2],
                        'name' => $row[3],
                        'phone' => $row[4],
                        'email' => $row[5],
                        // 'dob' => $row[3],
                        'address' => $row[8],
                        'post_code' => $row[10],
                        'em_contact_name' => $row[11],
                        'em_contact_relation' => $row[12],
                        'em_contact_phone' => $row[13],
                        'em_contact_email' => $row[14],
                        // 'joining_date' => $row[3],
                        'last_educational_qual' => $row[16],
                        'password' => $password,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $user['gender'] = explode('.', $row[6])[0] ?? null;
                    $user['district_id'] = explode('.', $row[9])[0] ?? null;
                    $user['employment_type'] = explode('.', $row[17])[0] ?? 1;
                    $preparedData[] = $user;
                } else {
                    $failedData[] = $row;
                }
            }

            if ($failedData) {
                session()->flash('error_data', $failedData);
            }
            throw_if($failedData, new Exception('No data saved. There are some invalid data in the excel. Please fix & upload again', 105));

            DB::transaction(function () use ($preparedData, $excelData) {
                DB::table('users')->insert($preparedData);

                $userid_list = array_column($preparedData, 'userid');
                $inserted_users = DB::table('users')->whereIn('userid', $userid_list)->get();

                $user_types = DB::table('roles')->get();

                $user_roles = [];
                foreach ($excelData as $row) {
                    foreach ($inserted_users as $user) {

                        // make primary roles array
                        if ($row[0] && $row[2] && $row[2] == $user->userid) {
                            $role_id =  explode('.', $row[0])[0] ?? null;

                            if ($role_id) {
                                $user_roles[] = [
                                    'role_id' => $role_id,
                                    'user_id' => $user->id,
                                    'is_primary' => 1,
                                ];
                            }
                        }

                        // make other roles array
                        if ($row[1] && $row[2] && $row[2] == $user->userid) {
                            $other_roles =  explode(',', $row[1]) ?? [];

                            foreach ($other_roles as $other_role) {
                                $other_role = trim($other_role);

                                $role = $user_types->firstWhere('slug', $other_role);
                                if ($role) {
                                    $user_roles[] = [
                                        'role_id' => $role->id,
                                        'user_id' => $user->id,
                                        'is_primary' => 0,
                                    ];
                                }
                            }
                        }
                    }
                }

                $user_roles = $this->duplicate_record_remove($user_roles);
                if ($user_roles) {
                    DB::table('role_user')->insert($user_roles);
                }
            });
            session()->flash('success', 'User data inserted succesfully');

        } catch (Exception $e) {
            if ($e->getCode() == 23000) {
                session()->flash('error', 'Failed! No data saved. Duplicate USER CODE found');
            } else {
                session()->flash('error', 'Something error with excel data. Carefully fix it & upload again');
            }
        }

        return back();
    }

    public function duplicate_record_remove($user_roles)
    {
        $user_roles = array_intersect_key( $user_roles , array_unique( array_map('serialize' , $user_roles ) ) );
        return $user_roles;
    }
}
