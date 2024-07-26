<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use app\Models\BarangLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $barangs = Barang::query()
            ->where('no_barcode', 'like', "%{$search}%")
            ->orWhere('no_item', 'like', "%{$search}%")
            ->orWhere('nama_barang', 'like', "%{$search}%")
            ->orWhere('kode_log', 'like', "%{$search}%")
            ->orWhere('jumlah', 'like', "%{$search}%")
            ->orWhere('satuan', 'like', "%{$search}%")
            ->orWhere('harga', 'like', "%{$search}%")
            ->orWhere('rak', 'like', "%{$search}%")
            ->orWhere('total', 'like', "%{$search}%")
            ->orWhere('tanggal', 'like', "%{$search}%")
            ->orWhere('jumlah_minimal', 'like', "%{$search}%")
            ->orWhere('no_katalog', 'like', "%{$search}%")
            ->orWhere('merk', 'like', "%{$search}%")
            ->orWhere('no_akun', 'like', "%{$search}%")
            ->get();

    foreach ($barangs as $barang) {
        $barang->qr_code = base64_encode(QrCode::format('svg')->size(100)->generate($barang->no_barcode));
    }

        return view('barangs.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $randomBarcode = 'SB-' . Str::random(8); // Example of a structured barcode
        return view('barangs.create', compact('randomBarcode'));
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
            'jumlah' => 'required|integer',
            'satuan' => 'required|string|max:255',
            'harga' => 'required|integer',
            'rak' => 'required|string|max:255',
            'total' => 'required|integer',
            'tanggal' => 'required|date',
            'jumlah_minimal' => 'required|integer',
            'no_katalog' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'no_akun' => 'required|string|max:255',
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
            'jumlah' => 'required|integer',
            'satuan' => 'required|string|max:255',
            'harga' => 'required|integer',
            'rak' => 'required|string|max:255',
            'total' => 'required|integer',
            'tanggal' => 'required|date',
            'jumlah_minimal' => 'required|integer',
            'no_katalog' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'no_akun' => 'required|string|max:255',
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

    public function entry(Request $request, Barang $barang)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Logic for adding quantity to the barang
        $barang->jumlah += $request->input('quantity');
        $barang->save();

        // Record the entry in the logs
        $barang->logs()->create([
            'action' => 'entry',
            'quantity' => $request->input('quantity'),
            'created_at' => now(),
        ]);

        return redirect()->route('barangs.index')->with('success', 'Entry recorded successfully.');
    }

    public function exit(Request $request, Barang $barang)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Logic for subtracting quantity from the barang
        if ($barang->jumlah < $request->input('quantity')) {
            return redirect()->route('barangs.index')->with('error', 'Insufficient quantity.');
        }

        $barang->jumlah -= $request->input('quantity');
        $barang->save();

        // Record the exit in the logs
        $barang->logs()->create([
            'action' => 'exit',
            'quantity' => $request->input('quantity'),
            'created_at' => now(),
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
            ->orWhere('jumlah', 'like', "%{$search}%")
            ->orWhere('satuan', 'like', "%{$search}%")
            ->orWhere('harga', 'like', "%{$search}%")
            ->orWhere('rak', 'like', "%{$search}%")
            ->orWhere('total', 'like', "%{$search}%")
            ->orWhere('tanggal', 'like', "%{$search}%")
            ->orWhere('jumlah_minimal', 'like', "%{$search}%")
            ->orWhere('no_katalog', 'like', "%{$search}%")
            ->orWhere('merk', 'like', "%{$search}%")
            ->orWhere('no_akun', 'like', "%{$search}%")
            ->get();

    foreach ($barangs as $barang) {
        $barang->qr_code = base64_encode(QrCode::format('svg')->size(100)->generate($barang->no_barcode));
    }

        return view('barangs.view', compact('barangs'));
    }
}


