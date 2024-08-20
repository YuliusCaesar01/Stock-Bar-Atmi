<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Orders;
use App\Models\WPLink;
use App\Models\ItemAdd;
use App\Models\BarangLog;
use App\Models\UnitKerja;
use App\Models\MasterAkun;
use App\Models\namabarang;
use Illuminate\Support\Str;
use App\Models\StockSummary;
use Illuminate\Http\Request;
use App\Models\CancelHistory;
use App\Models\KodeInstitusi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BarangController extends Controller
{

    public function dashboard()
    {
        // Get data and group by kd_prod and date
        $barangs = Barang::selectRaw('log_gudangs_tables.kd_prod, barangs.kode_log, barangs.no_item, DATE(barangs.created_at) as date, barangs.jumlah, barangs.jumlah_minimal, barangs.jumlah_maksimal, SUM(barangs.jumlah) as total, barangs.updated_at')
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

        return view('dashboard', [
            'chartData' => $chartData,
            'labels' => $labels,
            'stockCategories' => $stockCategories,
        ]);
    }





    public function getJenisBarang($kd_akun)
    {
        // Log the incoming kd_akun
        Log::debug('Fetching jenis_barang for kd_akun:', ['kd_akun' => $kd_akun]);

        // Attempt to retrieve the jenis_barang
        $jenis_barang = MasterAkun::where('kd_akun', $kd_akun)->pluck('jenis_barang')->first();

        if ($jenis_barang) {
            Log::info('jenis_barang found:', ['kd_akun' => $kd_akun, 'jenis_barang' => $jenis_barang]);
            return response()->json(['success' => true, 'jenis_barang' => $jenis_barang]);
        } else {
            Log::warning('jenis_barang not found for kd_akun:', ['kd_akun' => $kd_akun]);
            return response()->json(['success' => false]);
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Log::info('Index method started.');

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
        $barangs = Barang::query()
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

        return view('barangs.index', compact('barangs', 'orders', 'institusi', 'unitkerja'));
    }






    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $randomBarcode = 'SB-' . Str::random(8); // Example of a structured barcode
        $namabarangs = namabarang::all();
        return view('barangs.create', compact('randomBarcode', 'namabarangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Log the incoming request data
        Log::debug('Received store request with data:', [
            'request_data' => $request->all(),
            'user_id' => auth()->user()->id
        ]);

        // Validate the request data
        try {
            $validated = $request->validate([
                'no_barcode' => 'required|string|max:255',
                'no_item' => 'required|string|max:255',
                'nama_barang' => 'required|string|max:255',
                'kode_log' => 'required|string|max:255',
                'kd_akun' => 'required|string|max:255',
                'jumlah' => 'required|integer',
                'satuan' => 'required|string|max:255',
                'harga' => 'required|integer',
                'rak' => 'required|string|max:255',
                'total' => 'required|integer',
                'tanggal' => 'required|date',
                'jumlah_minimal' => 'required|integer',
                'jumlah_maksimal' => 'required|integer',
                'no_katalog' => 'required|string|max:255',
                'merk' => 'required|string|max:255',
                'no_reff' => 'required|string|max:255',
            ]);

            Log::debug('Validation passed.', ['validated_data' => $validated]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed.', [
                'errors' => $e->errors(),
                'request_data' => $request->all(),
                'user_id' => auth()->user()->id
            ]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // Attempt to create the Barang record
        try {
            $barang = Barang::create($validated);

            Log::info('Barang created successfully.', [
                'user_id' => auth()->user()->id,
                'barang_id' => $barang->id,
                'barang_data' => $validated
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create Barang.', [
                'exception_message' => $e->getMessage(),
                'request_data' => $validated,
                'user_id' => auth()->user()->id
            ]);
            return redirect()->back()->with('error', 'Failed to create Barang.')->withInput();
        }

        return redirect()->route('barangs.index')->with('success', 'Barang created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->qr_code = QrCode::size(100)->generate($barang->no_barcode);
        $logs = $barang->logs;

        return view('barangs.show', compact('barang', 'logs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $barang = Barang::findOrFail($id);
        if (is_null($barang->no_barcode)) {
            $barang->no_barcode = 'SB-' . Str::random(8); // Example of a structured barcode
        }

        return view('barangs.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'no_barcode' => 'required|string|max:255',
            'no_item' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'kode_log' => 'required|string|max:255',
            'kd_akun' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'satuan' => 'required|string|max:255',
            'harga' => 'required|integer',
            'rak' => 'required|string|max:255',
            'total' => 'required|integer',
            'tanggal' => 'required|date',
            'jumlah_minimal' => 'required|integer',
            'jumlah_maksimal' => 'required|integer',
            'no_katalog' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'no_reff' => 'required|string|max:255',
        ]);

        $barang->update($validated);

        return redirect()->route('barangs.index')->with('success', 'Barang updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barangs.index')->with('success', 'Barang deleted successfully.');
    }

    public function entry(Request $request)
    {
        // Log the request data and the ID of the barang
        Log::info('Entry request received', ['request_data' => $request->all(), 'barang_id' => $request->barang_id]);

        // Validate the request
        $validatedData = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'no_po' => 'required|string',
            'harga' => 'required|integer',
            'jumlah_beli' => 'required|integer|min:1',
            'operator' => 'required|string|max:255',
        ]);

        // Retrieve the correct barang instance
        $barang = Barang::find($request->barang_id);

        // Log validation success and the ID of the barang
        Log::info('Entry request validated', ['validated_data' => $validatedData, 'barang_id' => $barang->id]);

        // Logic for adding quantity to the barang
        $barang->harga = $validatedData['harga'];
        $barang->jumlah += $validatedData['jumlah_beli'];
        $barang->total = $barang->harga * $barang->jumlah;
        $kd_log=$barang->kode_log;
        $no_barang=$barang->no_item;
        $barang->save();

        // Log the updated barang data
        Log::info('Barang updated', ['barang' => $barang]);

        // Record the entry in the logs
        $log = $barang->logs()->create([
            'action' => 'entry',
            'quantity' => $validatedData['jumlah_beli'],
            'harga' => $validatedData['harga'],
            'no_po' => $validatedData['no_po'],
            'operator' => $validatedData['operator'],
            'kd_log' => $kd_log,
            'no_barang' => $no_barang,
            'created_at' => now(),
        ]);

        // Log the creation of the log entry
        Log::info('Log entry created', ['log' => $log, 'barang_id' => $barang->id]);

        return redirect()->route('barangs.index')->with('success', 'Entry recorded successfully.');
    }

    public function getBarangDetails($nama_barang)
    {
        $barang = Barang::find($nama_barang);
        return response()->json($barang);
    }

    public function getOrderItems($order_number)
    {
        $items = ItemAdd::where('order_number', $order_number)->get();
        return response()->json($items);
    }


    public function exit(Request $request)
    {
        try {
            // Log the request data
            Log::info('Exit request received', ['request_data' => $request->all()]);

            // Validate the request
            $validatedData = $request->validate([
                'barang_id' => 'required|exists:barangs,id',
                'nama_barang' => 'required|string|max:255',
                'no_barcode' => 'required|string|max:255',
                'jumlah_sekarang' => 'required|integer',
                'kode_log' => 'required|string|max:255',
                'no_bom' => 'required|string|max:255',
                'institusi' => 'required|string|max:255',
                'order_number' => 'required|string|max:255',
                'no_item' => 'required|string|max:255',
                'tanggal' => 'required|date',
                'jumlah_keluar' => 'required|integer',
                'satuan' => 'required|string|max:255',
                'operator' => 'required|string|max:255',
                'jenis' => 'required|string|max:255',
            ]);

            // Log the validated data
            Log::info('Validated data', ['validated_data' => $validatedData]);

            $barang = Barang::find($validatedData['barang_id']);

            // Log before checking stock
            Log::info('Checking stock levels', [
                'barang_id' => $barang->id,
                'current_stock' => $barang->jumlah,
                'requested_quantity' => $validatedData['jumlah_keluar']
            ]);

            if ($barang->jumlah < $validatedData['jumlah_keluar']) {
                Log::error('Insufficient stock', [
                    'barang_id' => $barang->id,
                    'current_stock' => $barang->jumlah,
                    'requested_quantity' => $validatedData['jumlah_keluar']
                ]);
                return redirect()->route('barangs.index')->with('error', 'Jumlah Stok Kurang.');
            }

            // Update stock of the barang
            $barang->jumlah -= $validatedData['jumlah_keluar'];
            $barang->total = $barang->harga * $barang->jumlah;
            $kd_log=$barang->kode_log;
            $no_barang=$barang->no_item;


            // Log before saving the barang
            Log::info('Updating barang', [
                'barang_id' => $barang->id,
                'new_stock' => $barang->jumlah,
                'new_total' => $barang->total
            ]);

            $barang->save();

            // Record the exit in the logs
            Log::info('Creating log entry for exit', [
                'barang_id' => $barang->id,
                'log_data' => [
                    'action' => 'exit',
                    'order_number' => $validatedData['order_number'],
                    'no_item' => $validatedData['no_item'],
                    'quantity' => $validatedData['jumlah_keluar'],
                    'satuan' => $validatedData['satuan'],
                    'operator' => $validatedData['operator'],
                    'jenis' => $validatedData['jenis'],
                    'kd_log' => $kd_log,
                    'no_barang' => $no_barang,
                    'created_at' => now(),
                ]
            ]);

            $log = $barang->logs()->create([
                'action' => 'exit',
                'order_number' => $validatedData['order_number'],
                'no_item' => $validatedData['no_item'],
                'quantity' => $validatedData['jumlah_keluar'],
                'satuan' => $validatedData['satuan'],
                'operator' => $validatedData['operator'],
                'jenis' => $validatedData['jenis'],
                'kd_log' => $kd_log,
                'no_barang' => $no_barang,
                'created_at' => now(),
            ]);

            // Log the log entry creation
            Log::info('Log entry created successfully', [
                'barang_id' => $barang->id,
                'log_data' => $log
            ]);

            // Record the additional details in WPLink model with log_id
            Log::info('Creating WPLink entry', [
                'wplink_data' => [
                    'order_number' => $validatedData['order_number'],
                    'no_item' => $validatedData['no_item'],
                    'barcode_id' => $validatedData['no_barcode'],
                    'material' => $validatedData['nama_barang'],
                    'tanggal' => $validatedData['tanggal'],
                    'jumlah' => $validatedData['jumlah_keluar'],
                    'harga' => $barang->harga,
                    'total' => $validatedData['jumlah_keluar'] * $barang->harga,
                    'satuan' => $validatedData['satuan'],
                    'jenis' => $validatedData['jenis'],
                    'log_id' => $log->id, // Adding log_id here
                ]
            ]);

            WPLink::create([
                'order_number' => $validatedData['order_number'],
                'no_item' => $validatedData['no_item'],
                'barcode_id' => $validatedData['no_barcode'],
                'material' => $validatedData['nama_barang'],
                'tanggal' => $validatedData['tanggal'],
                'jumlah' => $validatedData['jumlah_keluar'],
                'harga' => $barang->harga,
                'total' => $validatedData['jumlah_keluar'] * $barang->harga,
                'satuan' => $validatedData['satuan'],
                'jenis' => $validatedData['jenis'] === 'STANDART PART' ? 'parts' : ($validatedData['jenis'] === 'MATERIAL' ? 'materials' : $validatedData['jenis']),
                'log_id' => $log->id, // Saving log_id here
            ]);

            // Log the WPLink creation
            Log::info('WPLink entry created successfully', [
                'wplink_data' => [
                    'order_number' => $validatedData['order_number'],
                    'no_item' => $validatedData['no_item'],
                    'barcode_id' => $validatedData['no_barcode'],
                    'material' => $validatedData['nama_barang'],
                    'tanggal' => $validatedData['tanggal'],
                    'jumlah' => $validatedData['jumlah_keluar'],
                    'harga' => $barang->harga,
                    'total' => $validatedData['jumlah_keluar'] * $barang->harga,
                    'satuan' => $validatedData['satuan'],
                    'jenis' => $validatedData['jenis'],
                    'log_id' => $log->id, // Logging log_id
                ]
            ]);

            return redirect()->route('barangs.index')->with('success', 'Exit recorded successfully.');
        } catch (\Exception $e) {
            // Log the exception with stack trace
            Log::error('Exception occurred in exit method', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('barangs.index')->with('error', 'An error occurred.');
        }
    }






    public function logs(Barang $barang)
    {
        $logs = $barang->logs;

        return view('barangs.show', compact('barang', 'logs'));
    }

    public function searchAndExit(Request $request)
    {
        $request->validate([
            'no_barcode' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $qrCode = $request->input('qr_code');
        $quantity = $request->input('quantity');

        $barang = Barang::where('no_barcode', $qrCode)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang not found');
        }

        if ($barang->jumlah < $quantity) {
            return redirect()->back()->with('error', 'Insufficient quantity available');
        }

        $barang->jumlah -= $quantity;
        $barang->save();

        return redirect()->back()->with('success', 'Quantity exited successfully');
    }
    public function view(Request $request)
    {
        $search = $request->input('search');

        $barangs = Barang::query()
            ->where('no_barcode', 'like', "%{$search}%")
            ->orWhere('no_item', 'like', "%{$search}%")
            ->orWhere('nama_barang', 'like', "%{$search}%")
            ->orWhere('kode_log', 'like', "%{$search}%")
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
            ->orWhere('no_reff', 'like', "%{$search}%")
            ->get();

        foreach ($barangs as $barang) {
            $barang->qr_code = base64_encode(QrCode::format('svg')->size(100)->generate($barang->no_barcode));
        }

        return view('barangs.view', compact('barangs'));
    }

    public function bulkDelete(Request $request)
    {
        $logIds = $request->input('log_ids');

        if ($logIds) {
            // Fetch logs and sort them by date from newest to oldest
            $logs = BarangLog::whereIn('id', $logIds)
                ->orderBy('created_at', 'desc')
                ->get();

            foreach ($logs as $log) {
                $barang = Barang::find($log->barang_id);

                if ($barang) {
                    if ($log->action === 'exit') {
                        $barang->jumlah += $log->quantity;
                        Log::info('Membatalkan Pengambilan Stock untuk Barang ID ' . $barang->id . ' dengan jumlah ' . $log->quantity);
                    } elseif ($log->action === 'entry') {
                        $barang->jumlah -= $log->quantity;
                        Log::info('Membatalkan Penambahan Stock untuk Barang ID ' . $barang->id . ' dengan jumlah ' . $log->quantity);
                    }

                    $barang->save();
                    Log::info('Updated Barang ID ' . $barang->id . ' to new jumlah: ' . $barang->jumlah);

                    // Store the deleted log into CancelHistory with no_item from Barang
                    $cancelHistory = new CancelHistory();
                    $cancelHistory->log_id = $log->id;
                    $cancelHistory->barang_id = $log->barang_id;
                    $cancelHistory->action = $log->action;
                    $cancelHistory->quantity = $log->quantity;
                    $cancelHistory->created_at = $log->created_at;
                    $cancelHistory->no_item = $barang->no_item; // Added no_item from Barang model
                    $cancelHistory->save();

                    // Delete related WPLink entries
                    $wpLinksDeleted = WPLink::where('log_id', $log->id)->delete();
                    Log::info('Deleted ' . $wpLinksDeleted . ' WPLink entry(ies) with Log ID: ' . $log->id);
                } else {
                    Log::warning('Barang not found for Log ID ' . $log->id);
                }
            }

            BarangLog::whereIn('id', $logIds)->delete();
            Log::info('Deleted logs with IDs: ' . implode(', ', $logIds));

            return redirect()->back()->with('success', 'Selected logs have been deleted.');
        }

        Log::warning('No log IDs were selected for deletion.');
        return redirect()->back()->with('error', 'No logs were selected.');
    }

}
