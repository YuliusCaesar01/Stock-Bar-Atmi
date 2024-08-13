<?php

namespace App\Http\Controllers;

use App\Models\KodeInstitusi;
use Illuminate\Http\Request;

class KodeInstitusiController extends Controller
{
    public function index()
    {
        $institusi = KodeInstitusi::all();
        return view('setup.setupinstitusi', compact('institusi'));
    }

    public function create()
    {
        return view('setupinstitusi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_ins' => 'required|unique:kode_institusi',
            'nama_ins' => 'required',
        ]);

        KodeInstitusi::create($request->all());

        return redirect()->route('setupinstitusi')->with('success', 'Institusi created successfully.');
    }

    public function show(KodeInstitusi $institusi)
    {
        return view('setupinstitusi', compact('institusi'));
    }

    public function edit(KodeInstitusi $institusi)
    {
        return view('setupinstitusi', compact('institusi'));
    }

    public function update(Request $request, $id)
    {
        $institusi = KodeInstitusi::findOrFail($id);
        $institusi->update($request->all());

        return redirect()->route('setupinstitusi')->with('success', 'Institusi updated successfully.');
    }

    public function destroy($id)
    {
        $institusi = KodeInstitusi::findOrFail($id);
        $institusi->delete();

        return redirect()->route('setupinstitusi')->with('success', 'Institusi deleted successfully.');
    }
}
