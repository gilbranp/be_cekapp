<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TugasController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tugas = Tugas::with('penerima', 'pembuat')->get();
        return response()->json($tugas, 200);
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
        
         // Validate incoming request
         $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'batas_waktu' => 'nullable|date',
            'status' => 'nullable|in:Belum Mulai,Sedang Dikerjakan,Selesai',
            'prioritas' => 'nullable|in:Rendah,Sedang,Tinggi',
            'diberikan_kepada' => 'required|exists:users,id',
        ]);

        // Create new task
        $tugas = Tugas::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'batas_waktu' => $request->batas_waktu,
            'status' => $request->status ?? 'Belum Mulai',
            'prioritas' => $request->prioritas ?? 'Sedang',
            'diberikan_kepada' => $request->diberikan_kepada,
            'dibuat_oleh' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Tugas berhasil dibuat',
            'tugas' => $tugas
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil tugas bersama dengan relasi user yang terkait (penerima dan pembuat)
        $tugas = Tugas::with(['penerima', 'pembuat'])->find($id);
    
        if (!$tugas) {
            return response()->json(['message' => 'Tugas tidak ditemukan'], 404);
        }
    
        return response()->json($tugas);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tugas $tugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);
        $this->authorize('update', $tugas);

        $request->validate([
            'status' => 'in:Belum Mulai,Sedang Dikerjakan,Selesai',
        ]);

        $tugas->update($request->only('status'));

        return response()->json(['message' => 'Tugas berhasil diupdate', 'tugas' => $tugas], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $tugas = Tugas::find($id);
    
    if (!$tugas) {
        return response()->json(['message' => 'Tugas tidak ditemukan'], 404);
    }
    
    $tugas->delete();
    
    return response()->json(['message' => 'Tugas berhasil dihapus'], 200);
}
}
