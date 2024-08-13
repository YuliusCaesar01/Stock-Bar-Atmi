<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Orders;
use App\Models\WPLink;
use App\Models\ItemAdd;
use app\Models\BarangLog;
use App\Models\UnitKerja;
use App\Models\namabarang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KodeInstitusi;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $institusi = KodeInstitusi::all();
        $unitkerja = UnitKerja::all();
        $orders = Orders::where('order_status', '!=', 'Finished')->get();

        $barangs = Barang::query()
            ->where('no_barcode', 'like', "%{$search}%")
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
            ->orWhere('no_reff', 'like', "%{$search}%")
            ->get();

        foreach ($barangs as $barang) {
            $barang->qr_code = base64_encode(QrCode::format('svg')->size(100)->generate($barang->no_barcode));
        }

        return view('barangs.index', compact('barangs','orders','institusi','unitkerja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $randomBarcode = 'SB-' . Str::random(8); // Example of a structured barcode
        $namabarangs = namabarang::all();
        return view('barangs.create', compact('randomBarcode','namabarangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_barcode' => 'required|string|max:255',
            'no_item' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'kode_log' => 'required|string|max:255',
            'kd_unit' => 'required|string|max:255',
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
            'no_akun' => 'required|string|max:255',
            'no_reff' => 'required|string|max:255',
        ]);

        Barang::create($validated);

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
            'kd_ins' => 'required|string|max:255',
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
            'no_akun' => 'required|string|max:255',
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
        // Log the request data
        Log::info('Exit request received', ['request_data' => $request->all()]);

        // Validate the request
        $validatedData = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'nama_barang' => 'required|string|max:255',
            'no_barcode' => 'required|string|max:255',
            'jumlah_sekarang' => 'required|integer',
            'kode_log' => 'required|string|max:255',
            'kd_akun' => 'required|string|max:255',
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

        // Logic for subtracting quantity from the barang
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
        $barang->save();

        // Log the stock update
        Log::info('Stock updated', [
            'barang_id' => $barang->id,
            'new_stock' => $barang->jumlah,
            'new_total' => $barang->total
        ]);

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
                'created_at' => now(),
            ]
        ]);

        $barang->logs()->create([
            'action' => 'exit',
            'order_number' => $validatedData['order_number'],
            'no_item' => $validatedData['no_item'],
            'quantity' => $validatedData['jumlah_keluar'],
            'satuan' => $validatedData['satuan'],
            'operator' => $validatedData['operator'],
            'jenis' => $validatedData['jenis'],
            'created_at' => now(),
        ]);

        // Log the log entry creation
        Log::info('Log entry created successfully', [
            'barang_id' => $barang->id,
            'log_data' => [
                'action' => 'exit',
                'order_number' => $validatedData['order_number'],
                'no_item' => $validatedData['no_item'],
                'quantity' => $validatedData['jumlah_keluar'],
                'satuan' => $validatedData['satuan'],
                'operator' => $validatedData['operator'],
                'created_at' => now(),
            ]
        ]);

        // Record the additional details in WPLink model
        Log::info('Creating WPLink entry', [
            'wplink_data' => [
                'order_number' => $validatedData['order_number'],
                'no_item' => $validatedData['no_item'],
                'barcode_id' => $validatedData['no_barcode'],
                'material' => $validatedData['nama_barang'],
                'tanggal' => $validatedData['tanggal'],
                'jumlah' => $validatedData['jumlah_keluar'],
                'harga' => $barang->harga, // Ensure WPLink table has 'harga' column
                'satuan' => $validatedData['satuan'],
                'jenis' => $validatedData['jenis'],
            ]
        ]);

        WPLink::create([
            'order_number' => $validatedData['order_number'],
            'no_item' => $validatedData['no_item'],
            'barcode_id' => $validatedData['no_barcode'],
            'material' => $validatedData['nama_barang'],
            'tanggal' => $validatedData['tanggal'],
            'jumlah' => $validatedData['jumlah_keluar'],
            'harga' => $barang->harga, // Ensure WPLink table has 'harga' column
            'satuan' => $validatedData['satuan'],
            'jenis' => $validatedData['jenis'],
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
                'satuan' => $validatedData['satuan'],
                'jenis' => $validatedData['jenis'],
            ]
        ]);

        return redirect()->route('barangs.index')->with('success', 'Exit recorded successfully.');
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
}
