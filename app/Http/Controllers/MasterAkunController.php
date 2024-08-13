<?php

namespace App\Http\Controllers;

use App\Models\MasterAkun;
use Illuminate\Http\Request;

class MasterAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masterakuns = MasterAkun::all();
        return view('setup.setupmasterakun', compact('masterakuns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setupmasterakun');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kd_akun' => 'required|string|max:255',
            'nama_akun' => 'required|string|max:255',
            'kelompok' => 'nullable|string',
            'jenis_kelompok' => 'nullable|string',
        ]);

        MasterAkun::create($request->all());

        return redirect()->route('setupmasterakun')->with('success', 'Master Akun created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterAkun $masterakuns)
    {
        return view('setupmasterakun', compact('masterakuns'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterAkun $masterakuns)
    {
        return view('setupmasterakun', compact('masterakuns'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $masterakuns = MasterAkun::findOrFail($id);
        $masterakuns->update($request->all());

        return redirect()->route('setupmasterakun')->with('success', 'Master Akun updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    // Find the specific log record by its ID
    $masterakuns = MasterAkun::findOrFail($id);

    // Delete the log record
    $masterakuns->delete();

    // Redirect with a success message
    return redirect()->route('setupmasterakun')->with('success', 'Master Akun deleted successfully.');
    
    }
}
