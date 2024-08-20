<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Orders;
use App\Models\UnitKerja;
use App\Models\StockSummary;
use Illuminate\Http\Request;
use App\Models\KodeInstitusi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReportController extends Controller
{
    public function kondisistock(Request $request)
    {
        Log::info('KondisiStock method started.');

        $search = $request->input('search');
        Log::info('Search term:', ['search' => $search]);

        $institusi = KodeInstitusi::all();
        $unitkerja = UnitKerja::all();
        $orders = Orders::where('order_status', '!=', 'Finished')->get();

        Log::info('Supporting data retrieved', [
            'institusi_count' => $institusi->count(),
            'unitkerja_count' => $unitkerja->count(),
            'orders_count' => $orders->count(),
        ]);

        // Get the authenticated user's kd_prod
        $user = auth()->user();
        $userPlant = $user->plant;
        $userRole = $user->role; // Assuming 'role' is a property on the User model
        Log::info('Authenticated user plant and role:', ['plant' => $userPlant, 'role' => $userRole]);

        // Filter barangs based on matching kode_log and kd_prod
        $barangs = barang::query()
            ->when(!in_array($userRole, ['superadmin', 'viewer']), function ($query) use ($userPlant) {
                $query->whereHas('logGudang', function ($query) use ($userPlant) {
                    $query->where('kd_prod', $userPlant)
                        ->whereColumn('kd_log', 'barangs.kode_log'); // Ensure matching kode_log
                });
            })
            ->where(function ($query) use ($search) {
                $query->where('no_barcode', 'like', "%{$search}%")
                    ->orWhere('no_item', 'like', "%{$search}%")
                    ->orWhere('nama_barang', 'like', "%{$search}%")
                    ->orWhere('kode_log', 'like', "%{$search}%")
                    ->orWhere('kd_unit', 'like', "%{$search}%")
                    ->orWhere('kd_akun', 'like', "%{$search}%")
                    ->orWhere('jumlah', 'like', "%{$search}%")
                    ->orWhere('satuan', 'like', "%{$search}%")
                    ->orWhere('harga', 'like', "%{$search}%")
                    ->orWhere('rak', 'like', "%{$search}%")
                    ->orWhere('total', 'like', "%{$search}%")
                    ->orWhere('tanggal', 'like', "%{$search}%")
                    ->orWhere('jumlah_minimal', 'like', "%{$search}%")
                    ->orWhere('jumlah_maksimal', 'like', "%{$search}%")
                    ->orWhere('no_katalog', 'like', "%{$search}%")
                    ->orWhere('merk', 'like', "%{$search}%")
                    ->orWhere('no_akun', 'like', "%{$search}%")
                    ->orWhere('no_reff', 'like', "%{$search}%");
            })
            ->get();

        Log::info('Filtered barangs retrieved', ['barangs_count' => $barangs->count()]);

        foreach ($barangs as $barang) {
            $barang->qr_code = base64_encode(QrCode::format('svg')->size(100)->generate($barang->no_barcode));
            Log::info('QR code generated for barang', ['barang_id' => $barang->id]);
        }

        Log::info('Index method finished.');

        return view('report.kondisistock', compact('barangs', 'orders', 'institusi', 'unitkerja'));
    }

    public function jumlahstock()
    {
        // Get data and group by kd_prod and date
        $barangs = barang::selectRaw('log_gudangs_tables.kd_prod, barangs.kode_log, barangs.no_item, DATE(barangs.created_at) as date, barangs.jumlah, barangs.jumlah_minimal, barangs.jumlah_maksimal, SUM(barangs.jumlah) as total, barangs.updated_at')
            ->join('log_gudangs_tables', 'barangs.kode_log', '=', 'log_gudangs_tables.kd_log')
            ->groupBy('log_gudangs_tables.kd_prod', 'barangs.kode_log', 'barangs.no_item', 'date', 'barangs.jumlah', 'barangs.jumlah_minimal', 'barangs.jumlah_maksimal', 'barangs.updated_at')
            ->orderBy('date')
            ->get();

        // Initialize stock categories (Safe, Warning, Danger)
        $stockCategories = [
            'Safe' => 0,
            'Warning' => 0,
            'Danger' => 0,
        ];

        // Initialize an array to store the accumulated jumlah for each kd_prod
        $jumlahAccumulation = [];

        foreach ($barangs as $barang) {
            // Ensure the date is correctly parsed
            $barangDate = Carbon::parse($barang->created_at)->format('Y-m-d');

            // Calculate the stock condition based on the new rules
            $minPlus10Percent = $barang->jumlah_minimal + ($barang->jumlah_minimal * 0.1);
            $condition = 'Safe'; // Default to Safe

            if ($barang->jumlah < $barang->jumlah_minimal || $barang->jumlah > $barang->jumlah_maksimal) {
                $condition = 'Danger';
            } elseif ($barang->jumlah >= $barang->jumlah_minimal && $barang->jumlah <= $minPlus10Percent) {
                $condition = 'Warning';
            } elseif ($barang->jumlah > $minPlus10Percent && $barang->jumlah < $barang->jumlah_maksimal) {
                $condition = 'Safe';
            }

            // Update the stock categories count
            $stockCategories[$condition]++;
            Log::info("Barang Code: {$barang->kode_log}, Condition: {$condition}, Jumlah: {$barang->jumlah}, Min: {$barang->jumlah_minimal}, Max: {$barang->jumlah_maksimal}, Min + 10%: {$minPlus10Percent}");

            // Continue as before, but use $barangDate
            if (!isset($jumlahAccumulation[$barang->kd_prod][$barangDate])) {
                $jumlahAccumulation[$barang->kd_prod][$barangDate] = 0;
            }
            $jumlahAccumulation[$barang->kd_prod][$barangDate] += $barang->jumlah;

            Log::info("Accumulating KD_Prod: {$barang->kd_prod}, Date: {$barangDate}, Jumlah: {$barang->jumlah}");
        }


        // After the loop, update or create records in StockSummaries
        foreach ($jumlahAccumulation as $kd_prod => $dates) {
            foreach ($dates as $date => $totalJumlah) {
                Log::info("Processing KD_Prod: {$kd_prod}, Date: {$date}, Total Stock: {$totalJumlah}");

                StockSummary::updateOrCreate(
                    [
                        'kd_prod' => $kd_prod,
                        'date' => $date,
                    ],
                    [
                        'total_stock' => $totalJumlah
                    ]
                );

                Log::info("StockSummary Updated/Created: KD_Prod: {$kd_prod}, Date: {$date}, Total Stock: {$totalJumlah}");
            }
        }

        // Fetch the data from StockSummary model
        $stockData = StockSummary::select('kd_prod', 'total_stock', 'date')
            ->get()
            ->groupBy('kd_prod');

        // Prepare the data for the chart
        $chartData = [];
        $allDates = [];

        foreach ($stockData as $kd_prod => $data) {
            $seriesData = [];

            // Convert the collection to an array and sort it by date
            $dataArray = $data->toArray();
            usort($dataArray, function ($a, $b) {
                return strtotime($a['date']) - strtotime($b['date']);
            });

            // Collect the sorted dates and series data
            foreach ($dataArray as $entry) {
                $allDates[] = $entry['date']; // Collect all unique dates
                $seriesData[] = $entry['total_stock']; // Collect the stock data
            }

            // Convert KD_Prod to the correct name
            $name = ($kd_prod === 'W') ? 'WF' : (($kd_prod === 'M') ? 'MDC' : $kd_prod);

            $chartData[] = [
                'name' => $name,
                'data' => $seriesData,
            ];
        }


        // Remove duplicate labels and ensure they are sorted
        $labels = array_values(array_unique($allDates));
        sort($labels);

        // Log the final stock categories
        Log::info('Final Stock Categories:', $stockCategories);
        Log::info('Chart Data:', $chartData);
        Log::info('Labels:', $labels);

        return view('report/jumlahstock', [
            'chartData' => $chartData,
            'labels' => $labels,
            'stockCategories' => $stockCategories,
        ]);
    }
    public function daftarbarang(Request $request)
    {

        // Retrieve all barangs without any filters
        $barangs = barang::all();

        Log::info('All barangs retrieved', ['barangs_count' => $barangs->count()]);

        foreach ($barangs as $barang) {
            $barang->qr_code = base64_encode(QrCode::format('svg')->size(100)->generate($barang->no_barcode));
            Log::info('QR code generated for barang', ['barang_id' => $barang->id]);
        }

        Log::info('Index method finished.');

        return view('report.daftarbarang', compact('barangs'));
    }

}
