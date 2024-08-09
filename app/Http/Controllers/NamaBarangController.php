<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NamaBarang;
use App\Models\Satuan;
use Illuminate\Http\Request;

class NamaBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nama=NamaBarang::all();
        $satuan = Satuan::all();
        return view('setup.setupbarang',compact('nama','satuan'));
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
    $request->validate([
        'no_item' => 'required|string|max:255',
        'nama_barang' => 'required|string|max:255',
        'kode_log' => 'required|string|max:255',
        'satuan' => 'required|string|max:255',
    ]);

    NamaBarang::create([
        'no_item' => $request->no_item,
        'nama_barang' => $request->nama_barang,
        'kode_log' => $request->kode_log,
        'satuan' => $request->satuan,
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
