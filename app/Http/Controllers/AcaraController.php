<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;

class AcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return Acara::all();
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
            'judul' => 'required',
            'tanggal_acara' => 'required'
        ]);

        $acara = Acara::create($validateData);
        return response()->json($acara,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Acara $acara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Acara $acara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       
        $validateData = $request->validate([
            'judul' => 'required',
            'tanggal_acara' => 'required'
        ]);
        $acara = Acara::findOrFail($id);
        $acara->update($request->only(['judul','tanggal_acara']));
        return response()->json($acara);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $acara = Acara::findOrFail($id);
        $acara->delete();
        return response()->json(null,204);
    }
}
