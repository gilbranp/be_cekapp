<?php

use App\Http\Controllers\AcaraController;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/users', function () {
    return User::all();
});

// Kategori
Route::apiResource('/kategori',KategoriController::class);

Route::get('/kategori', [KategoriController::class, 'index']);


// Barang
Route::get('/barang', [BarangController::class, 'index']);
Route::post('/barang', [BarangController::class, 'store']);
Route::delete('/barang/{id}', [BarangController::class, 'destroy']);
Route::put('/barang/{id}', [BarangController::class, 'update']);

// Keuangan
Route::apiResource('/keuangan',KeuanganController::class);


// Acara
Route::apiResource('/acara',AcaraController::class);


// Kelola User
Route::apiResource('/users',UserController::class);

Route::middleware('auth:sanctum')->group(function(){

    Route::get('/logout', [AuthController::class, 'logout']);
});

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register',[AuthController::class,'register']);

// Tugas
Route::apiResource('/tugas',TugasController::class);