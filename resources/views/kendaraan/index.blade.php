<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kendaraan - Bengkel Maju Motor</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-neutral-950 p-8 min-h-screen text-gray-100">
    <div class="max-w-4xl mx-auto bg-neutral-900 p-6 rounded-2xl shadow-xl border border-purple-900/40">
        
        <!-- Menu Navigasi Gabungan -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6 border-b border-purple-900/60 pb-4">
            <div class="flex gap-4">
                <a href="{{ route('pelanggan.index') }}" class="text-neutral-400 hover:text-purple-400 font-medium text-sm transition">Data Pelanggan</a>
                <a href="{{ route('kendaraan.index') }}" class="text-purple-400 font-bold border-b-2 border-purple-400 pb-1 text-sm">Data Kendaraan</a>
                <a href="{{ route('servis.index') }}" class="text-neutral-400 hover:text-purple-400 font-medium text-sm transition">Pendaftaran Servis</a>
            </div>
            <div>
                <a href="{{ route('dashboard') }}" class="bg-purple-900 hover:bg-purple-800 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">🏠 Menu Utama</a>
            </div>
        </div>

        <h1 class="text-2xl font-bold mb-6 text-white border-b border-neutral-800 pb-2">Manajemen Kendaraan</h1>

        @if(session('success'))
            <div class="bg-purple-955/80 border border-purple-500 text-purple-200 px-4 py-3 rounded-xl mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('kendaraan.store') }}" method="POST" class="mb-8 bg-neutral-955/60 p-5 rounded-xl border border-purple-900/40">
            @csrf
            <h2 class="text-md font-bold mb-4 text-purple-300">Registrasi Kendaraan Pelanggan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 uppercase">Pilih Pemilik (Pelanggan)</label>
                    <select name="pelanggan_id" required class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 focus:border-purple-500 focus:outline-none text-sm cursor-pointer">
                        <option value="" class="bg-neutral-900">-- Pilih Pelanggan --</option>
                        @foreach($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}" class="bg-neutral-900">{{ $pelanggan->nama_pelanggan }} (ID: {{ $pelanggan->id }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 uppercase">Nomor Polisi (No. Plat)</label>
                    <input type="text" name="no_polisi" required placeholder="Contoh: B 1234 ABC" class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 focus:border-purple-500 focus:outline-none text-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 uppercase">Merk Kendaraan</label>
                    <input type="text" name="merk_kendaraan" required placeholder="Honda, Yamaha" class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 focus:border-purple-500 focus:outline-none text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 uppercase">Model / Tipe</label>
                    <input type="text" name="model_tipe" required placeholder="Vario 150, NMAX" class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 focus:border-purple-500 focus:outline-none text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 uppercase">Tahun Produksi</label>
                    <input type="number" name="tahun_produksi" placeholder="2020" class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 focus:border-purple-500 focus:outline-none text-sm">
                </div>
            </div>

            <button type="submit" class="bg-purple-600 text-white px-5 py-2 rounded-lg hover:bg-purple-700 text-sm font-bold transition cursor-pointer shadow-md shadow-purple-900/20">Daftarkan Kendaraan</button>
        </form>

        <h2 class="text-md font-bold mb-4 text-purple-300">Daftar Kendaraan Terregistrasi</h2>
        <div class="overflow-x-auto rounded-xl border border-neutral-800">
            <table class="min-w-full divide-y divide-neutral-800">
                <thead class="bg-neutral-950">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-neutral-400 uppercase tracking-wider border-b border-neutral-800">No. Polisi</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-neutral-400 uppercase tracking-wider border-b border-neutral-800">Pemilik</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-neutral-400 uppercase tracking-wider border-b border-neutral-800">Kendaraan</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-neutral-400 uppercase tracking-wider border-b border-neutral-800">Tahun</th>
                    </tr>
                </thead>
                <tbody class="bg-neutral-900/40 divide-y divide-neutral-800">
                    @forelse($kendaraans as $k)
                        <tr class="hover:bg-neutral-800/30 transition">
                            <td class="px-6 py-4 text-sm font-bold text-white">{{ $k->no_polisi }}</td>
                            <td class="px-6 py-4 text-sm text-neutral-300">{{ $k->pelanggan->nama_pelanggan }}</td>
                            <td class="px-6 py-4 text-sm text-neutral-300">{{ $k->merk_kendaraan }} {{ $k->model_tipe }}</td>
                            <td class="px-6 py-4 text-sm text-neutral-400">{{ $k->tahun_produksi ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-neutral-500">Belum ada data kendaraan terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>