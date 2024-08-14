<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use App\Models\LogGudang;
use App\Models\MasterAkun;
use App\Models\NamaBarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NamaBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nama=NamaBarang::all();
        $satuan = Satuan::all();
        $logs = LogGudang::all();
        $masterakuns = MasterAkun::all();
        return view('setup.setupbarang',compact('nama','satuan','logs','masterakuns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
// Store method to save a new NamaBarang
public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'kode_log' => 'required|string|max:255',
        'kd_akun' => 'required|string|max:255',
        'satuan' => 'required|string|max:255',
        'harga' => 'required|integer',
        'jumlah_minimal' => 'required|integer',
        'jumlah_maksimal' => 'required|integer',
        'rak' => 'required|string|max:255',
        'no_katalog' => 'required|string|max:255',
        'merk' => 'required|string|max:255',
        'no_reff' => 'required|string|max:255',
    ]);

    // Automatically generate the 'no' value based on kode_log
    $lastItem = NamaBarang::where('kode_log', $request->kode_log)
                          ->orderBy('no', 'desc')
                          ->first();
    $newNo = $lastItem ? $lastItem->no + 1 : 1001;

    // Generate the 'no_item' in the format kd_akun-kode_log-no
    $no_item = $request->kd_akun . '-' . $request->kode_log . '-' . $newNo;

    // Create a new NamaBarang record with the generated 'no_item' and 'no' value
    NamaBarang::create([
        'no_item' => $no_item,
        'nama_barang' => $request->nama_barang,
        'kode_log' => $request->kode_log,
        'satuan' => $request->satuan,
        'harga' => $request->harga,
        'jumlah_minimal' => $request->jumlah_minimal,
        'jumlah_maksimal' => $request->jumlah_maksimal,
        'rak' => $request->rak,
        'no_katalog' => $request->no_katalog,
        'merk' => $request->merk,
        'no_reff' => $request->no_reff,
        'kd_akun' => $request->kd_akun,
        'no' => $newNo,
    ]);

    return redirect()->route('setupbarang')->with('success', 'Nama Barang added successfully.');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $barang = NamaBarang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('setupbarang')->with('success', 'Nama barang updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $barang = NamaBarang::findOrFail($id);
        $barang->delete();

        return redirect()->route('setupbarang')->with('success', 'Nama barang deleted successfully');
    }
}
