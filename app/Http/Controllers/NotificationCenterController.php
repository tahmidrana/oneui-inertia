<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationCenterController extends Controller
{
    public function __construct()
    {
        view()->share('main_menu', 'dashboard');
    }

    public function index()
    {
        $user = auth()->user();
        $user->load('roles');
        return view('notifications.index', compact('user'));
    }
}
