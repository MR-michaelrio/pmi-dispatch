<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PatientRequest;
use App\Models\Dispatch;
use App\Models\DispatchLog;
use App\Models\Driver;
use App\Models\Ambulance;
use Illuminate\Http\Request;

class PatientRequestController extends Controller
{
    public function index()
    {
        $requests = PatientRequest::with('dispatch')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.patient_requests.index', compact('requests'));
    }

    public function show(PatientRequest $patientRequest)
    {
        return view('admin.patient_requests.show', compact('patientRequest'));
    }

    public function createDispatch(PatientRequest $patientRequest)
    {
        $drivers = Driver::where('status', 'available')->get();
        $ambulances = Ambulance::where('status', 'ready')->get();

        return view('admin.dispatches.create', [
            'drivers' => $drivers,
            'ambulances' => $ambulances,
            'patientRequest' => $patientRequest,
        ]);
    }

    public function reject(PatientRequest $patientRequest)
    {
        $patientRequest->update(['status' => 'rejected']);

        return redirect()->route('admin.patient-requests.index')
            ->with('success', 'Permintaan ditolak');
    }
}
