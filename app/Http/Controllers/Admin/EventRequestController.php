<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EventRequest;

class EventRequestController extends Controller
{
    public function index()
    {
        $events = EventRequest::orderByDesc('created_at')->get();
        return view('admin.event_requests.index', compact('events'));
    }

    public function create()
    {
        return view('admin.event_requests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'needs' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        EventRequest::create($validated + ['status' => 'approved']);

        return redirect()->route('admin.event-requests.index')->with('success', 'Kegiatan Event berhasil dibuat.');
    }

    public function edit(EventRequest $eventRequest)
    {
        return view('admin.event_requests.edit', compact('eventRequest'));
    }

    public function update(Request $request, EventRequest $eventRequest)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'needs' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $eventRequest->update($validated);

        return redirect()->route('admin.event-requests.index')->with('success', 'Kegiatan Event berhasil diperbarui.');
    }

    public function destroy(EventRequest $eventRequest)
    {
        $eventRequest->delete();
        return back()->with('success', 'Event berhasil dihapus.');
    }

    public function approve(EventRequest $eventRequest)
    {
        $eventRequest->update(['status' => 'approved']);
        return back()->with('success', 'Event disetujui.');
    }

    public function reject(EventRequest $eventRequest)
    {
        $eventRequest->update(['status' => 'rejected']);
        return back()->with('success', 'Event ditolak.');
    }

    // PUBLIC PORTAL METHODS
    public function publicCreate()
    {
        return view('patient_request.event_create'); // Reusing the patient request style
    }

    public function publicStore(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'needs' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        EventRequest::create($validated + ['status' => 'pending']);

        return redirect()->route('portal')->with('success', 'Permintaan Event Anda telah terkirim dan akan segera kami tinjau.');
    }
}
