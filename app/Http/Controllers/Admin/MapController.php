<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;

class MapController extends Controller
{
    public function index()
    {
        $ambulances = Ambulance::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('admin.maps.index', compact('ambulances'));
    }
}
