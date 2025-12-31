<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;

class MapsController extends Controller
{
    public function index()
    {
        // Ambil ambulance yang punya GPS
        $ambulances = Ambulance::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('admin.maps.index', compact('ambulances'));
    }
}
