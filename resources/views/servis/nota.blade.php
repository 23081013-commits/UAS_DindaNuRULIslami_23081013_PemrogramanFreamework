<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Servis #{{ $servis->id }}</title>
    <style>
        body { font-family: monospace; width: 300px; margin: 20px auto; font-size: 14px; color: #333; }
        .text-center { text-align: center; }
        .line { border-bottom: 1px dashed #000; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 3px 0; }
        .btn-print { background: #333; color: #fff; border: none; padding: 5px 10px; cursor: pointer; display: block; width: 100%; text-align: center; margin-bottom: 10px; font-weight: bold; }
        @media print { .btn-print { display: none; } body { margin: 0; width: 100%; } }
    </style>
</head>
<body>

    <button class="btn-print" onclick="window.print()">🖨️ CETAK NOTA</button>

    <div class="text-center">
        <strong>BENGKEL MAJU MOTOR</strong><br>
        Jl. Bukit Indah No. 12<br>
        ============================
    </div>

    <table>
        <tr><td>Nota ID</td><td>: #{{ $servis->id }}</td></tr>
        <tr><td>Tanggal</td><td>: {{ $servis->tanggal_servis }}</td></tr>
        <tr><td>Pelanggan</td><td>: {{ $servis->kendaraan->pelanggan->nama_pelanggan }}</td></tr>
        <tr><td>No. HP</td><td>: {{ $servis->kendaraan->pelanggan->telepon }}</td></tr>
    </table>
    
    <div class="line"></div>
    
    <table>
        <tr><td>No. Plat</td><td>: {{ $servis->kendaraan->no_polisi }}</td></tr>
        <tr><td>Kendaraan</td><td>: {{ $servis->kendaraan->merk_kendaraan }} {{ $servis->kendaraan->model_tipe }}</td></tr>
    </table>

    <div class="line"></div>
    <strong>Rincian Perbaikan & Biaya (Poin 8 & 9):</strong>
    <table style="font-size: 13px; margin-top: 5px;">
        <tr>
            <td style="max-width: 180px; word-break: break-word;">Jasa: {{ $servis->keluhan_awal }}</td>
            <td style="text-align: right; vertical-align: top;">Rp {{ number_format($servis->biaya_jasa, 0, ',', '.') }}</td>
        </tr>
        @if($servis->nama_sparepart)
        <tr>
            <td style="max-width: 180px; word-break: break-word;">Sparepart: {{ $servis->nama_sparepart }}</td>
            <td style="text-align: right; vertical-align: top;">Rp {{ number_format($servis->biaya_sparepart, 0, ',', '.') }}</td>
        </tr>
        @endif
    </table>
    
    <div class="line"></div>

    <table style="font-weight: bold;">
        <tr>
            <td>TOTAL BIAYA</td>
            <td style="text-align: right;">Rp {{ number_format($servis->biaya_jasa + $servis->biaya_sparepart, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>STATUS BENGKEL</td>
            <td style="text-align: right;">LUNAS / SELESAI</td>
        </tr>
    </table>

    <div class="line"></div>
    <div class="text-center" style="margin-top: 20px;">
        Terima kasih atas kepercayaan Anda!<br>
        Semoga berkendara dengan aman.
    </div>

</body>
</html>