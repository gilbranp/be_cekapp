<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'kategori_id', 'stok', 'status'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
