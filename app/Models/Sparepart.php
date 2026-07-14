<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit sesuai cetakan migrasi
    protected $table = 'spareparts';

    // Mengizinkan kolom-kolom ini diisi saat proses query builder / Eloquent
    protected $fillable = [
        'nama_sparepart',
        'harga_jual',
        'stok'
    ];
}