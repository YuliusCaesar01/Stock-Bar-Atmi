<?php

namespace App\Http\Controllers;

use App\Models\BarangLog;
use Illuminate\Http\Request;
use App\Models\BarangSummary;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

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

    public function getStockRecap(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));
    
        // Debugging output
        \Log::info('Fetching stock recap for date: ' . $date);
    
        $stockRecap = BarangSummary::with('barang')
            ->whereDate('summary_date', '<=', $date)
            ->orderBy('summary_date', 'asc')
            ->orderBy('barang_id')
            ->get();
    
        \Log::info('Stock recap results: ', $stockRecap->toArray());
    
        return view('report.saldobulanan', compact('stockRecap', 'date'));
    }
    

    public function summarizeLogs()
    {
        // Select barang_id, summary_date, and summarize total entries and exits
        $logs = BarangLog::select('barang_id')
            ->selectRaw('DATE(updated_at) as summary_date')
            ->selectRaw('SUM(CASE WHEN action = "entry" THEN quantity ELSE 0 END) as total_entry')
            ->selectRaw('SUM(CASE WHEN action = "exit" THEN quantity ELSE 0 END) as total_exit')
            ->groupBy('barang_id', 'summary_date')
            ->get();
    
        foreach ($logs as $log) {
            \Log::info('Processing log: ', $log->toArray());
    
            // Update or create the summary for the same barang_id and summary_date
            BarangSummary::updateOrCreate(
                [
                    'barang_id' => $log->barang_id,
                    'summary_date' => $log->summary_date,
                ],
                [
                    'total_entry' => $log->total_entry,
                    'total_exit' => $log->total_exit,
                ]
            );
        }
    
        return response()->json(['message' => 'Barang summary updated successfully.']);
    }
    


    

    

}
