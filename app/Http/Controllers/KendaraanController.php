<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    // Ini fungsi index yang dicari oleh Laravel
    public function index()
    {
        $kendaraans = Kendaraan::with('pelanggan')->get();
        $pelanggans = Pelanggan::all();
        return view('kendaraan.index', compact('kendaraans', 'pelanggans'));
    }

    // Ini fungsi store untuk menyimpan data
    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'no_polisi' => 'required|string|max:15|unique:kendaraans,no_polisi',
            'merk_kendaraan' => 'required|string|max:50',
            'model_tipe' => 'required|string|max:50',
            'tahun_produksi' => 'nullable|integer',
        ]);

        Kendaraan::create($request->all());
        return redirect()->back()->with('success', 'Data kendaraan berhasil didaftarkan!');
    }
}