<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produksi = Produksi::all();
        return view('setup.setupproduksi', compact('produksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setupproduksi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kd_prod' => 'required|string|max:255',
            'nama_prod' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Produksi::create($request->all());

        return redirect()->route('setupproduksi')->with('success', 'Produksi created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produksi $produksi)
    {
        return view('setupproduksi', compact('produksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produksi $produksi)
    {
        return view('setupproduksi', compact('produksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produksi = Produksi::findOrFail($id);
        $produksi->update($request->all());

        return redirect()->route('setupproduksi')->with('success', 'Produksi updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    // Find the specific log record by its ID
    $produksi = Produksi::findOrFail($id);

    // Delete the log record
    $produksi->delete();

    // Redirect with a success message
    return redirect()->route('setupproduksi')->with('success', 'Produksi deleted successfully.');
    
    }
}
