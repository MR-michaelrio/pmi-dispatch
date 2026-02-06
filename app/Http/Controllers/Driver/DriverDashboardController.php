<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Dispatch;
use Illuminate\Http\Request;

class DriverDashboardController extends Controller
{
    public function index()
    {
        $driver = auth()->user();
        
        // Get active dispatch for this driver
        $activeDispatch = Dispatch::where('driver_id', $driver->id)
            ->whereIn('status', ['assigned', 'enroute_pickup', 'on_scene', 'enroute_hospital'])
            ->with('ambulance')
            ->first();

        return view('driver.dashboard', compact('activeDispatch'));
    }
}
