<?php

namespace App\Http\Controllers;

use App\Models\ServisPendaftaran;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServisController extends Controller
{
    public function index()
    {
        // Mengambil data pendaftaran beserta relasi detail pecahan baru
        $serviss = ServisPendaftaran::with(['kendaraan.pelanggan', 'detailServis.detailSpareparts.sparepart', 'pembayaran'])->get();
        $kendaraans = Kendaraan::with('pelanggan')->get();
        return view('servis.index', compact('serviss', 'kendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'tanggal_servis' => 'required|date',
            'keluhan_awal' => 'required|string',
            'status_servis' => 'required|in:Antri,Dikerjakan,Selesai,Dibatalkan',
            'nama_sparepart' => 'nullable|string|max:100',
            'biaya_sparepart' => 'nullable|numeric',
            'biaya_jasa' => 'nullable|numeric',
        ]);

        // Gunakan Database Transaction agar jika satu tabel error, semua dibatalkan (aman)
        DB::transaction(function () use ($request) {
            // 1. Simpan ke tabel induk: servis_pendaftarans
            $servis = ServisPendaftaran::create([
                'kendaraan_id' => $request->kendaraan_id,
                'tanggal_servis' => $request->tanggal_servis,
                'status_servis' => $request->status_servis,
            ]);

            // Untuk sementara, kita hubungkan ke Mekanik ID 1 (Pastikan data mekanik ada)
            // Atau buat default mekanik terlebih dahulu jika belum ada data mekanik
            $mekanikId = DB::table('mekaniks')->first()?->id;
            if (!$mekanikId) {
                $mekanikId = DB::table('mekaniks')->insertGetId([
                    'nama_mekanik' => 'Mekanik Utama',
                    'spesialisasi' => 'Umum',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // 2. Simpan ke tabel pecahan: detail_servis
            $detailServisId = DB::table('detail_servis')->insertGetId([
                'servis_pendaftaran_id' => $servis->id,
                'mekanik_id' => $mekanikId,
                'keluhan_kerusakan' => $request->keluhan_awal,
                'biaya_jasa' => $request->biaya_jasa ?? 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // 3. Simpan ke tabel pecahan jika memakai sparepart: detail_spareparts
            if ($request->nama_sparepart) {
                // Cari atau buat sparepart otomatis di master tabel spareparts
                $sparepartId = DB::table('spareparts')->where('nama_sparepart', $request->nama_sparepart)->first()?->id;
                if (!$sparepartId) {
                    $sparepartId = DB::table('spareparts')->insertGetId([
                        'nama_sparepart' => $request->nama_sparepart,
                        'harga_jual' => $request->biaya_sparepart ?? 0,
                        'stok' => 10,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }

                DB::table('detail_spareparts')->insert([
                    'detail_servis_id' => $detailServisId,
                    'sparepart_id' => $sparepartId,
                    'jumlah' => 1,
                    'subtotal_harga' => $request->biaya_sparepart ?? 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // 4. Jika status langsung diset 'Selesai', buat pencatatan otomatis di tabel pembayarans
            if ($request->status_servis == 'Selesai') {
                DB::table('pembayarans')->insert([
                    'servis_pendaftaran_id' => $servis->id,
                    'tanggal_bayar' => $request->tanggal_servis,
                    'total_bayar' => ($request->biaya_jasa ?? 0) + ($request->biaya_sparepart ?? 0),
                    'metode_pembayaran' => 'Tunai',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        });

        return redirect()->back()->with('success', 'Pendaftaran & pecahan data servis berhasil disimpan sesuai struktur MySQL!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_servis' => 'required|in:Antri,Dikerjakan,Selesai,Dibatalkan',
        ]);

        $servis = ServisPendaftaran::findOrFail($id);
        
        DB::transaction(function () use ($servis, $request) {
            $servis->update(['status_servis' => $request->status_servis]);

            // Jika diupdate ke selesai, otomatis daftarkan ke pembayaran jika belum ada
            if ($request->status_servis == 'Selesai') {
                $sudahBayar = DB::table('pembayarans')->where('servis_pendaftaran_id', $servis->id)->exists();
                if (!$sudahBayar) {
                    $detail = DB::table('detail_servis')->where('servis_pendaftaran_id', $servis->id)->first();
                    $subtotalSparepart = DB::table('detail_spareparts')->where('detail_servis_id', $detail?->id)->sum('subtotal_harga');
                    
                    DB::table('pembayarans')->insert([
                        'servis_pendaftaran_id' => $servis->id,
                        'tanggal_bayar' => now()->toDateString(),
                        'total_bayar' => ($detail?->biaya_jasa ?? 0) + $subtotalSparepart,
                        'metode_pembayaran' => 'Tunai',
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        });

        return redirect()->back()->with('success', 'Status servis berhasil diperbarui!');
    }

    public function cetakNota($id)
{
    $servis = ServisPendaftaran::findOrFail($id);
    
    // PERBAIKAN: Mengubah detail_servis::mekanik_id menjadi detail_servis.mekanik_id
    $detail = DB::table('detail_servis')
        ->join('mekaniks', 'detail_servis.mekanik_id', '=', 'mekaniks.id')
        ->where('servis_pendaftaran_id', $id)
        ->first();

    $sparepart = DB::table('detail_spareparts')
        ->join('spareparts', 'detail_spareparts.sparepart_id', '=', 'spareparts.id')
        ->where('detail_servis_id', $detail?->id)
        ->first();

    return view('servis.nota', compact('servis', 'detail', 'sparepart'));
}

    public function laporanKeuangan()
    {
        // Hitung pendapatan bersumber dari tabel pembayarans resmi (Poin 10)
        $transaksiSelesai = ServisPendaftaran::with('kendaraan.pelanggan')
            ->where('status_servis', 'Selesai')
            ->get();
        
        $totalPendapatan = DB::table('pembayarans')->sum('total_bayar');
        $totalJasa = DB::table('detail_servis')->sum('biaya_jasa');
        $totalSparepart = DB::table('detail_spareparts')->sum('subtotal_harga');

        return view('servis.laporan', compact('transaksiSelesai', 'totalJasa', 'totalSparepart', 'totalPendapatan'));
    }
}