<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Keuangan::all());
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
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'keterangan' => 'required',
            'pemasukan' => 'required',
            'pengeluaran' => 'required',
        ]);

        $keuangan = Keuangan::create($validateData);
        return response()->json($keuangan,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Keuangan $keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keuangan $keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $keuangan = Keuangan::findOrFail($id);
        
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'pemasukan' => 'nullable|integer',
            'pengeluaran' => 'nullable|integer',
        ]);

        $keuangan->update($validatedData);
        return response()->json($keuangan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $keuangan = Keuangan::findOrFail($id);
        $keuangan->delete();
        return response()->json($keuangan,201);
    }
}
