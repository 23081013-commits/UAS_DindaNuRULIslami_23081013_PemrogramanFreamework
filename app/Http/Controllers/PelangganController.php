<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // Menampilkan daftar pelanggan
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggans'));
    }

    // Menyimpan data pelanggan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'telepon' => 'required|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        Pelanggan::create($request->all());

        return redirect()->back()->with('success', 'Data pelanggan berhasil ditambahkan!');
    }
}