<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendNewPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'userid' => 'required|string',
        ]);

        $user = User::query()
            ->where('userid', $request->userid)
            ->first();

        if($user) {
            $name = $user->name;
            $password = $this->random_strings(12);
            $user->password = Hash::make($password);
            $user->save();

            Mail::to($user->email)->send(new SendNewPassword($name, $password));
            session()->flash('success', 'Password sent to your email');
            return redirect()->route('login');
        }

        session()->flash('error', 'No user found with this ID');
        return back();
    }

    function random_strings($length_of_string)
    {

        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Shufle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result),
            0, $length_of_string);
    }
}
