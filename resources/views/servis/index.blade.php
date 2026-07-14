<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Servis - Bengkel Maju Motor</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-neutral-950 p-8 min-h-screen text-gray-100">
    <div class="max-w-4xl mx-auto bg-neutral-900 p-6 rounded-2xl shadow-xl border border-purple-900/40">
        
        <!-- Menu Navigasi Gabungan -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6 border-b border-purple-900/60 pb-4">
            <div class="flex gap-4">
                <a href="{{ route('pelanggan.index') }}" class="text-neutral-400 hover:text-purple-400 font-medium text-sm transition">Data Pelanggan</a>
                <a href="{{ route('kendaraan.index') }}" class="text-neutral-400 hover:text-purple-400 font-medium text-sm transition">Data Kendaraan</a>
                <a href="{{ route('servis.index') }}" class="text-purple-400 font-bold border-b-2 border-purple-400 pb-1 text-sm">Pendaftaran Servis</a>
                <a href="{{ route('servis.laporan') }}" class="text-neutral-400 hover:text-purple-400 font-medium text-sm transition">📊 Laporan Pendapatan</a>
            </div>
            <div>
                <a href="{{ route('dashboard') }}" class="bg-purple-900 hover:bg-purple-800 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">🏠 Menu Utama</a>
            </div>
        </div>

        <h1 class="text-2xl font-bold mb-6 text-white border-b border-neutral-800 pb-2">Pendaftaran Antrean & Pekerjaan Servis</h1>

        @if(session('success'))
            <div class="bg-purple-955/80 border border-purple-500 text-purple-200 px-4 py-3 rounded-xl mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Input -->
        <form action="{{ route('servis.store') }}" method="POST" class="mb-8 bg-neutral-955/60 p-5 rounded-xl border border-purple-900/40">
            @csrf
            <h2 class="text-md font-bold mb-4 text-purple-300">Pencatatan Kerusakan & Servis Baru (Poin 5 & 7)</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 uppercase">Pilih Kendaraan</label>
                    <select name="kendaraan_id" required class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 text-sm cursor-pointer">
                        <option value="" class="bg-neutral-900">-- Pilih Nomor Polisi --</option>
                        @foreach($kendaraans as $kendaraan)
                            <option value="{{ $kendaraan->id }}" class="bg-neutral-900">
                                {{ $kendaraan->no_polisi }} - {{ $kendaraan->merk_kendaraan }} ({{ $kendaraan->pelanggan->nama_pelanggan }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 uppercase">Tanggal Servis</label>
                    <input type="date" name="tanggal_servis" required value="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 text-sm scheme-dark">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-neutral-300 uppercase">Catatan Kerusakan Kendaraan (Keluhan)</label>
                <textarea name="keluhan_awal" rows="2" required placeholder="Contoh: Ganti oli mesin, kampas rem depan habis" class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 text-sm"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-neutral-300 uppercase">Sparepart Yang Digunakan</label>
                    <input type="text" name="nama_sparepart" placeholder="Kosongkan jika tidak ada" class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 uppercase">Harga Sparepart (Rp)</label>
                    <input type="number" name="biaya_sparepart" value="0" class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 uppercase">Biaya Jasa (Rp)</label>
                    <input type="number" name="biaya_jasa" value="0" class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 text-sm">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-neutral-300 uppercase">Status Awal</label>
                <select name="status_servis" required class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 text-sm cursor-pointer">
                    <option value="Antri" class="bg-neutral-900">Antri</option>
                    <option value="Dikerjakan" class="bg-neutral-900">Dikerjakan</option>
                </select>
            </div>

            <button type="submit" class="bg-purple-600 text-white px-5 py-2 rounded-lg hover:bg-purple-700 text-sm font-bold transition cursor-pointer">Masuk Antrean Bengkel</button>
        </form>

        <!-- Tabel Monitoring -->
        <h2 class="text-md font-bold mb-4 text-purple-300">Live Monitor Pekerjaan & Perhitungan Biaya (Poin 6 & 8)</h2>
        <div class="overflow-x-auto rounded-xl border border-neutral-800">
            <table class="min-w-full divide-y divide-neutral-800">
                <thead class="bg-neutral-950">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-neutral-400 uppercase">No. Polisi / Pemilik</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-neutral-400 uppercase">Kerusakan & Sparepart</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-neutral-400 uppercase">Total Biaya</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-neutral-400 uppercase">Aksi & Status Mekanik</th>
                    </tr>
                </thead>
                <tbody class="bg-neutral-900/40 divide-y divide-neutral-800">
                    @forelse($serviss as $s)
                        <tr class="hover:bg-neutral-800/30 transition">
                            <td class="px-4 py-4 text-sm text-white">
                                <span class="font-bold block text-purple-300">{{ $s->kendaraan->no_polisi }}</span>
                                <span class="text-xs text-neutral-400">{{ $s->kendaraan->pelanggan->nama_pelanggan }}</span>
                            </td>
                            <td class="px-4 py-4 text-sm text-neutral-300">
                                <div class="text-xs"><span class="text-neutral-500">Keluhan:</span> {{ $s->keluhan_awal }}</div>
                                @if($s->nama_sparepart)
                                    <div class="text-xs mt-1 text-purple-400"><span class="text-neutral-500">Sparepart:</span> {{ $s->nama_sparepart }} (Rp {{ number_format($s->biaya_sparepart, 0, ',', '.') }})</div>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-sm font-bold text-white">
                                Rp {{ number_format($s->biaya_jasa + $s->biaya_sparepart, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-4 text-sm">
                                <div class="flex items-center gap-2">
                                    <!-- Form Update Status Mekanik -->
                                    <form action="{{ route('servis.updateStatus', $s->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status_servis" onchange="this.form.submit()" class="text-xs font-bold rounded-lg p-1.5 border cursor-pointer transition
                                            {{ $s->status_servis == 'Antri' ? 'bg-blue-950 text-blue-400 border-blue-900' : '' }}
                                            {{ $s->status_servis == 'Dikerjakan' ? 'bg-amber-950 text-amber-400 border-amber-900' : '' }}
                                            {{ $s->status_servis == 'Selesai' ? 'bg-green-950 text-green-400 border-green-900' : '' }}
                                            {{ $s->status_servis == 'Dibatalkan' ? 'bg-red-950 text-red-400 border-red-900' : '' }}">
                                            <option value="Antri" class="bg-neutral-900" {{ $s->status_servis == 'Antri' ? 'selected' : '' }}>Antri</option>
                                            <option value="Dikerjakan" class="bg-neutral-900" {{ $s->status_servis == 'Dikerjakan' ? 'selected' : '' }}>Dikerjakan</option>
                                            <option value="Selesai" class="bg-neutral-900" {{ $s->status_servis == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="Dibatalkan" class="bg-neutral-900" {{ $s->status_servis == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                    </form>

                                    @if($s->status_servis == 'Selesai')
                                        <a href="{{ route('servis.cetakNota', $s->id) }}" target="_blank" class="bg-purple-700 hover:bg-purple-600 text-white text-xs px-2 py-1.5 rounded-lg transition font-bold">
                                            🖨️ Nota
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-neutral-500">Belum ada data pendaftaran servis.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>