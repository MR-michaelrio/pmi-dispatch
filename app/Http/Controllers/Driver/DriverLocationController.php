<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverLocationController extends Controller
{
    public function index()
    {
        return view('driver.track');
    }

    public function update(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $user = Auth::user();

        // Simpan lokasi ke session (simple & cepat)
        session([
            "driver_location_{$user->id}" => [
                'lat' => $request->lat,
                'lng' => $request->lng,
                'updated_at' => now(),
            ]
        ]);

        return response()->json(['success' => true]);
    }
}

