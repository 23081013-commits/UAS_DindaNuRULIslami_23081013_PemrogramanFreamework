<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServisPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'servis_pendaftarans';
    
    protected $fillable = [
        'kendaraan_id', 
        'tanggal_servis', 
        'status_servis',
        'nama_sparepart',
        'biaya_sparepart',
        'biaya_jasa'
    ];

    // Relasi ke Kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    // TAMBAHKAN RELASI 1: Ke tabel pecahan detail_servis
    public function detailServis()
    {
        return $this->hasMany(DetailServis::class, 'servis_pendaftaran_id');
    }

    // TAMBAHKAN RELASI 2: Ke tabel pembayarans
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'servis_pendaftaran_id');
    }
}