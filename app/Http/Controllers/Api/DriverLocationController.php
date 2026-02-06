<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverLocationController extends Controller
{
    public function updateLocation(Request $request)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        // Find driver's current ambulance
        $driver = Driver::find($validated['driver_id']);
        
        // Get active dispatch for this driver
        $dispatch = \App\Models\Dispatch::where('driver_id', $driver->id)
            ->whereIn('status', ['assigned', 'enroute_pickup', 'on_scene', 'enroute_hospital'])
            ->first();

        if ($dispatch && $dispatch->ambulance_id) {
            // Update ambulance location
            Ambulance::where('id', $dispatch->ambulance_id)->update([
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'last_location_update' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Location updated successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No active dispatch found'
        ], 404);
    }
}
