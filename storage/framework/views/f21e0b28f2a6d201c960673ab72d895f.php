<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Servis #<?php echo e($servis->id); ?></title>
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
        <tr><td>Nota ID</td><td>: #<?php echo e($servis->id); ?></td></tr>
        <tr><td>Tanggal</td><td>: <?php echo e($servis->tanggal_servis); ?></td></tr>
        <tr><td>Pelanggan</td><td>: <?php echo e($servis->kendaraan->pelanggan->nama_pelanggan); ?></td></tr>
        <tr><td>No. HP</td><td>: <?php echo e($servis->kendaraan->pelanggan->telepon); ?></td></tr>
    </table>
    
    <div class="line"></div>
    
    <table>
        <tr><td>No. Plat</td><td>: <?php echo e($servis->kendaraan->no_polisi); ?></td></tr>
        <tr><td>Kendaraan</td><td>: <?php echo e($servis->kendaraan->merk_kendaraan); ?> <?php echo e($servis->kendaraan->model_tipe); ?></td></tr>
    </table>

    <div class="line"></div>
    <strong>Rincian Perbaikan & Biaya (Poin 8 & 9):</strong>
    <table style="font-size: 13px; margin-top: 5px;">
        <tr>
            <td style="max-width: 180px; word-break: break-word;">Jasa: <?php echo e($servis->keluhan_awal); ?></td>
            <td style="text-align: right; vertical-align: top;">Rp <?php echo e(number_format($servis->biaya_jasa, 0, ',', '.')); ?></td>
        </tr>
        <?php if($servis->nama_sparepart): ?>
        <tr>
            <td style="max-width: 180px; word-break: break-word;">Sparepart: <?php echo e($servis->nama_sparepart); ?></td>
            <td style="text-align: right; vertical-align: top;">Rp <?php echo e(number_format($servis->biaya_sparepart, 0, ',', '.')); ?></td>
        </tr>
        <?php endif; ?>
    </table>
    
    <div class="line"></div>

    <table style="font-weight: bold;">
        <tr>
            <td>TOTAL BIAYA</td>
            <td style="text-align: right;">Rp <?php echo e(number_format($servis->biaya_jasa + $servis->biaya_sparepart, 0, ',', '.')); ?></td>
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
</html><?php /**PATH D:\laragon\www\assignment-bengkel\resources\views/servis/nota.blade.php ENDPATH**/ ?>