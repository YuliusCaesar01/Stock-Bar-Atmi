<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use App\Models\LogGudang;
use Illuminate\Http\Request;

class LogGudangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logs = LogGudang::all();
        $produksi = Produksi::all();
        return view('setup.setuploggudang', compact('logs','produksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('log_gudang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kd_prod' => 'required|string|max:255',
            'kd_log' => 'required|string|max:255',
            'nama_log' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        LogGudang::create($request->all());

        return redirect()->route('setuploggudang')->with('success', 'Log Gudang created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LogGudang $logGudang)
    {
        return view('log_gudang.show', compact('logGudang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogGudang $logGudang)
    {
        return view('log_gudang.edit', compact('logGudang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $logs = LogGudang::findOrFail($id);
        $logs->update($request->all());

        return redirect()->route('setuploggudang')->with('success', 'Log Gudang updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    // Find the specific log record by its ID
    $logs = LogGudang::findOrFail($id);

    // Delete the log record
    $logs->delete();

    // Redirect with a success message
    return redirect()->route('setuploggudang')->with('success', 'Log Gudang deleted successfully.');

    }
}
