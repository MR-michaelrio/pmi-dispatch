<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dispatch;
use App\Models\Driver;
use App\Models\Ambulance;

class DispatchController extends Controller
{
    /**
     * LIST DISPATCH
     */
    public function index()
    {
        $dispatches = Dispatch::with(['driver', 'ambulance'])
            ->orderByRaw("
                CASE 
                    WHEN status = 'assigned' THEN 1
                    WHEN status = 'enroute_pickup' THEN 2
                    WHEN status = 'on_scene' THEN 3
                    WHEN status = 'enroute_hospital' THEN 4
                    ELSE 5
                END
            ")
            ->orderByDesc('created_at')
            ->get();

        return view('admin.dispatches.index', compact('dispatches'));
    }

    /**
     * FORM DISPATCH BARU
     */
    public function create()
    {
        $drivers = Driver::where('status', 'available')->get();
        $ambulances = Ambulance::where('status', 'ready')->get();

        return view('admin.dispatches.create', compact('drivers', 'ambulances'));
    }

    /**
     * SIMPAN DISPATCH
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_name'      => 'required|string',
            'patient_condition' => 'required|in:emergency,kontrol,jenazah',
            'patient_phone'     => 'nullable|string',
            'pickup_address'    => 'required|string',
            'destination'       => 'nullable|string',
            'driver_id'         => 'required|exists:drivers,id',
            'ambulance_id'      => 'required|exists:ambulances,id',
        ]);

        $dispatch = Dispatch::create([
            'patient_name'      => $request->patient_name,
            'patient_condition' => $request->patient_condition,
            'patient_phone'     => $request->patient_phone,
            'pickup_address'    => $request->pickup_address,
            'destination'       => $request->destination,
            'driver_id'         => $request->driver_id,
            'ambulance_id'      => $request->ambulance_id,
            'status'            => 'assigned',
            'assigned_at'       => now(),
        ]);

        Driver::where('id', $request->driver_id)
            ->update(['status' => 'on_duty']);

        Ambulance::where('id', $request->ambulance_id)
            ->update(['status' => 'on_duty']);

        return redirect()
            ->route('admin.dispatches.index')
            ->with('success', 'Dispatch berhasil dibuat');
    }

    /**
     * SELESAIKAN DISPATCH
     */
    public function complete(Dispatch $dispatch)
    {
        $dispatch->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        $dispatch->driver?->update(['status' => 'available']);
        $dispatch->ambulance?->update(['status' => 'ready']);

        return back()->with('success', 'Dispatch selesai');
    }
}
