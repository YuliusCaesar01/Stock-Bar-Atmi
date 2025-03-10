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

    // Date filter
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $query->whereBetween('updated_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
    }

    // Action filter
    if ($request->filled('action')) {
        $query->where('action', $request->input('action'));
    }

    // Operator filter
    if ($request->filled('operator')) {
        $query->where('operator', $request->input('operator'));
    }

    // No PO filter
    if ($request->filled('no_po')) {
        $query->where('no_po', 'like', '%' . $request->input('no_po') . '%');
    }
    
    // Item name filter
    if ($request->filled('nama_barang')) {
        $searchTerm = $request->input('nama_barang');
        $query->whereHas('barang', function($q) use ($searchTerm) {
            $q->where('nama_barang', 'like', '%' . $searchTerm . '%');
        });
    }

    $logs = $query->get();
    
    // Get unique operators for the dropdown
    $operators = BarangLog::distinct()->pluck('operator')->filter();
    
    return view('logs', compact('logs', 'operators'));
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
