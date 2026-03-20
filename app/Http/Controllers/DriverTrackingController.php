<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;

class DriverTrackingController extends Controller
{
    public function update(Request $request)
    {
        Driver::where('id', $request->driver_id)->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'last_seen' => now(),
        ]);

        return response()->json(['ok' => true]);
    }
}

