<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dispatch;
use App\Models\Driver;
use App\Models\Ambulance;
use App\Models\DispatchLog;
use Barryvdh\DomPDF\Facade\Pdf;

class DispatchController extends Controller
{
    public function index()
    {
        $dispatches = Dispatch::with(['driver','ambulance','logs'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.dispatches.index', compact('dispatches'));
    }

    public function create()
    {
        return view('admin.dispatches.create', [
            'drivers' => Driver::where('status','available')->get(),
            'ambulances' => Ambulance::where('status','ready')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $dispatch = Dispatch::create($request->validate([
            'patient_name' => 'required',
            'patient_condition' => 'required',
            'pickup_address' => 'required',
            'destination' => 'nullable',
            'driver_id' => 'required',
            'ambulance_id' => 'required',
        ]) + [
            'status' => 'assigned',
            'assigned_at' => now(),
        ]);

        Driver::where('id', $dispatch->driver_id)->update(['status'=>'on_duty']);
        Ambulance::where('id', $dispatch->ambulance_id)->update(['status'=>'on_duty']);

        DispatchLog::create([
            'dispatch_id' => $dispatch->id,
            'status' => 'assigned',
            'note' => 'Dispatch dibuat'
        ]);

        return redirect()->route('admin.dispatches.index');
    }

    public function next(Dispatch $dispatch)
    {
        $flow = [
            'assigned' => 'enroute_pickup',
            'enroute_pickup' => 'on_scene',
            'on_scene' => 'enroute_hospital',
            'enroute_hospital' => 'completed',
        ];

        if (!isset($flow[$dispatch->status])) {
            return back();
        }

        $dispatch->update(['status' => $flow[$dispatch->status]]);

        DispatchLog::create([
            'dispatch_id' => $dispatch->id,
            'status' => $dispatch->status,
        ]);

        if ($dispatch->status === 'completed') {
            $dispatch->ambulance->update(['status'=>'ready']);
            $dispatch->driver->update(['status'=>'available']);
        }

        return back();
    }

    public function destroy(Dispatch $dispatch)
    {
        $dispatch->logs()->delete();
        $dispatch->delete();

        return back();
    }

    // ✅ EXPORT PDF
    public function exportPdf()
    {
        $dispatches = Dispatch::with(['driver','ambulance'])->get();

        $pdf = Pdf::loadView('admin.dispatches.pdf', compact('dispatches'));

        return $pdf->download('dispatch-report.pdf');
    }
}
