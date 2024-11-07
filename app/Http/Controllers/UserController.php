<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([

        // ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);
    
        // Validasi data, kecuali password jika tidak ada
        $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string',
            'role' => 'required|string',
            'nama_keluarga' => 'required|string',
        ]);
    
        // Siapkan data untuk di-update
        $updateData = [
            'nama' => $request->nama,
            'username' => $request->username,
            'role' => $request->role,
            'nama_keluarga' => $request->nama_keluarga
        ];
    
        // Jika password diisi, tambahkan ke data update dan hash password
        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }
    
        // Lakukan update
        $user->update($updateData);
    
        // Kembalikan respons sukses
        return response()->json([
            'message' => 'Data user berhasil diupdate',
            'user' => $user
        ], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json($user,201);
    }
}
