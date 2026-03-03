<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dispatch;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));
        
        $currentDate = Carbon::createFromDate($year, $month, 1);
        
        // Fetch All Dispatches
        $dispatches = Dispatch::with(['ambulance', 'driver'])
            ->whereMonth('request_date', $month)
            ->whereYear('request_date', $year)
            ->get();

        // Fetch Requests (not rejected)
        $requests = \App\Models\PatientRequest::where('status', '!=', 'rejected')
            ->whereMonth('request_date', $month)
            ->whereYear('request_date', $year)
            ->get();

        // Deduplicate: If a request has a dispatch_id, and that ID is in the dispatches collection, 
        // we prefer the dispatch record (as it has more operational info).
        $dispatchIdsInRequests = $requests->pluck('dispatch_id')->filter()->toArray();
        $dispatchedRequestsToSkip = $requests->filter(function($r) {
            return !empty($r->dispatch_id);
        });

        // We'll use a manually built collection to ensure no duplicates
        $finalCollection = collect();

        // Add all dispatches
        foreach($dispatches as $d) {
            $finalCollection->push($d);
        }

        // Add requests that are NOT already in dispatches
        foreach($requests as $r) {
            if (empty($r->dispatch_id)) {
                $finalCollection->push($r);
            }
        }

        // Merge and Group
        $data = $finalCollection->sortBy('pickup_time')
            ->groupBy(function($item) {
                if ($item->request_date instanceof Carbon) {
                    return $item->request_date->format('Y-m-d');
                }
                return Carbon::parse($item->request_date)->format('Y-m-d');
            });

        return view('admin.schedules.calendar', [
            'dispatches' => $data,
            'currentDate' => $currentDate,
        ]);
    }
}
