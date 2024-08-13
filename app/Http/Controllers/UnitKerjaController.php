<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
{
    public function index()
    {
        $unitkerja = UnitKerja::all();
        return view('setup.setupunitkerja', compact('unitkerja'));
    }

    public function create()
    {
        return view('setupunitkerja');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_unit' => 'required|unique:unit_kerjas',
            'nama_unit' => 'required',
        ]);

        UnitKerja::create($request->all());

        return redirect()->route('setupunitkerja')->with('success', 'Unit Kerja created successfully.');
    }

    public function show(UnitKerja $unitkerja)
    {
        return view('setupunitkerja', compact('unitkerja'));
    }

    public function edit(UnitKerja $unitkerja)
    {
        return view('setupunitkerja', compact('unitkerja'));
    }

    public function update(Request $request, $id)
    {
        $unitkerja = UnitKerja::findOrFail($id);
        $unitkerja->update($request->all());

        return redirect()->route('setupunitkerja')->with('success', 'Unit Kerja updated successfully.');
    }

    public function destroy($id)
    {
        $unitkerja = UnitKerja::findOrFail($id);
        $unitkerja->delete();

        return redirect()->route('setupunitkerja')->with('success', 'Unit Kerja deleted successfully.');
    }
}
