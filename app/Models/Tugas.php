<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'deskripsi', 'batas_waktu', 'status', 'prioritas', 'diberikan_kepada', 'dibuat_oleh'
    ];

    // Relasi dengan user yang diberi tugas
    public function penerima()
    {
        return $this->belongsTo(User::class, 'diberikan_kepada');
    }

    // Relasi dengan user yang membuat tugas
    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
