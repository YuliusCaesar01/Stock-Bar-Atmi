<?php

namespace App\Http\Controllers;

use App\Models\BarangLog;
use Illuminate\Http\Request;

class BarangLogController extends Controller
{
    /**
     * Display a listing of the resource with optional date range filtering.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = BarangLog::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            if ($startDate && $endDate) {
                $query->whereBetween('updated_at', [$startDate, $endDate]);
            }
        }

        $logs = $query->get();

        // Debugging output
        if ($request->has('start_date') || $request->has('end_date')) {
            echo 'Filtered Logs Count: ' . $logs->count() . '<br>';
        }

        return view('logs', compact('logs'));
    }

    // Additional methods for CRUD operations can be added here
}
