<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'servis_pendaftaran_id',
        'tanggal_bayar',
        'total_bayar',
        'metode_pembayaran'
    ];
}