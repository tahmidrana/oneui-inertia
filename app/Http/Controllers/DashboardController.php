<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return inertia('Dashboard/Index');
    }

    public function index1(Request $request)
    {
        $active_clients = 0;
        $active_clinicians = 0;
        $clinical_sessions = 0;
        $supervision = 0;
        $corporate_sessions = 0;
        $total_planned_hours = 0;

        $user = auth()->user();

        return view('dashboard.index', [
            'active_clients' => $active_clients,
            'active_clinicians' => $active_clinicians,
            'clinical_sessions' => $clinical_sessions,
            'supervision' => $supervision,
            'corporate_sessions' => $corporate_sessions,
            'total_planned_hours' => $total_planned_hours,
        ]);
    }
}
