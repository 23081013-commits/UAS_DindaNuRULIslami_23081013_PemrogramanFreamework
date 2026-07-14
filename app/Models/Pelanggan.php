<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang sesuai dengan migrasi sebelumnya
    protected $table = 'pelanggans';

    // Kolom yang diizinkan untuk diisi massal
    protected $fillable = [
        'nama_pelanggan',
        'telepon',
        'alamat'
    ];
}