<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index()
    {
        $satuan = Satuan::all();
        return view('setup.setupsatuan', compact('satuan'));
    }

    public function create()
    {
        return view('satuans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_satuan' => 'required|unique:satuans',
            'nama_satuan' => 'required',
        ]);

        Satuan::create($request->all());

        return redirect()->route('setupsatuan')->with('success', 'Satuan created successfully.');
    }

    public function show(Satuan $satuan)
    {
        return view('satuans.show', compact('satuan'));
    }

    public function edit(Satuan $satuan)
    {
        return view('satuans.edit', compact('satuan'));
    }

    public function update(Request $request, $id)
    {
        $satuan = Satuan::findOrFail($id);
        $satuan->update($request->all());

        return redirect()->route('setupsatuan')->with('success', 'Satuan updated successfully.');
    }

    public function destroy($id)
    {
        $satuan = Satuan::findOrFail($id);
        $satuan->delete();

        return redirect()->route('setupsatuan')->with('success', 'Satuan deleted successfully.');
    }
}
