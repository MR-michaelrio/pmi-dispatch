<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Models\Driver;
use App\Models\Dispatch;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalAmbulances' => Ambulance::count(),
            'totalDrivers'    => Driver::count(),
            'totalDispatches' => Dispatch::count(),

            'pendingDispatches'   => Dispatch::where('status', 'pending')->count(),
            'onDutyDispatches'    => Dispatch::where('status', 'on_duty')->count(),
            'completedDispatches' => Dispatch::where('status', 'completed')->count(),
        ]);
    }
}
