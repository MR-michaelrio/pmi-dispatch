<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dispatch;
use App\Models\Ambulance;
use App\Models\Driver;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        return view('admin.dashboard', [
            'totalDispatchToday' => Dispatch::whereDate('created_at', $today)->count(),

            'activeDispatch' => Dispatch::whereIn('status', [
                'assigned',
                'enroute_pickup',
                'on_scene',
                'enroute_hospital'
            ])->count(),

            'emergencyActive' => Dispatch::where('patient_condition', 'emergency')
                ->whereNotIn('status', ['completed', 'cancelled'])
                ->count(),

            'ambulanceReady' => Ambulance::where('status', 'ready')->count(),
            'ambulanceOnDuty' => Ambulance::where('status', 'on_duty')->count(),

            'driverAvailable' => Driver::where('status', 'available')->count(),
            'driverOnDuty' => Driver::where('status', 'on_duty')->count(),
        ]);
    }
}
