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
        
        $dispatches = Dispatch::with(['ambulance', 'driver'])
            ->whereMonth('request_date', $month)
            ->whereYear('request_date', $year)
            ->get()
            ->groupBy(function($d) {
                return $d->request_date->format('Y-m-d');
            });

        return view('admin.schedules.calendar', compact('dispatches', 'currentDate'));
    }
}
