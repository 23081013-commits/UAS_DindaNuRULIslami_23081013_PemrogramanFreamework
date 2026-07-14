<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pendapatan - Bengkel Maju Motor</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-neutral-950 p-8 min-h-screen text-gray-100">
    <div class="max-w-4xl mx-auto bg-neutral-900 p-6 rounded-2xl shadow-xl border border-purple-900/40">
        
        <!-- Menu Navigasi -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6 border-b border-purple-900/60 pb-4">
            <div class="flex gap-4">
                <a href="<?php echo e(route('pelanggan.index')); ?>" class="text-neutral-400 hover:text-purple-400 font-medium text-sm transition">Data Pelanggan</a>
                <a href="<?php echo e(route('kendaraan.index')); ?>" class="text-neutral-400 hover:text-purple-400 font-medium text-sm transition">Data Kendaraan</a>
                <a href="<?php echo e(route('servis.index')); ?>" class="text-neutral-400 hover:text-purple-400 font-medium text-sm transition">Pendaftaran Servis</a>
                <a href="<?php echo e(route('servis.laporan')); ?>" class="text-purple-400 font-bold border-b-2 border-purple-400 pb-1 text-sm">📊 Laporan Pendapatan</a>
            </div>
            <div>
                <a href="<?php echo e(route('dashboard')); ?>" class="bg-purple-900 hover:bg-purple-800 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">🏠 Menu Utama</a>
            </div>
        </div>

        <h1 class="text-2xl font-bold mb-6 text-white border-b border-neutral-800 pb-2">Rekap Keuangan & Pendapatan Bengkel (Poin 10)</h1>

        <!-- Ringkasan Pendapatan -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="p-4 bg-neutral-950 border border-neutral-800 rounded-xl">
                <span class="text-xs text-neutral-400 block uppercase font-bold">Total Pemasukan Jasa</span>
                <span class="text-xl font-black text-blue-400">Rp <?php echo e(number_format($totalJasa, 0, ',', '.')); ?></span>
            </div>
            <div class="p-4 bg-neutral-950 border border-neutral-800 rounded-xl">
                <span class="text-xs text-neutral-400 block uppercase font-bold">Total Penjualan Sparepart</span>
                <span class="text-xl font-black text-amber-400">Rp <?php echo e(number_format($totalSparepart, 0, ',', '.')); ?></span>
            </div>
            <div class="p-4 bg-purple-950/40 border border-purple-500 rounded-xl">
                <span class="text-xs text-purple-300 block uppercase font-bold">Total Pendapatan Bersih</span>
                <span class="text-2xl font-black text-green-400">Rp <?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></span>
            </div>
        </div>

        <h2 class="text-md font-bold mb-4 text-purple-300">Riwayat Transaksi Selesai</h2>
        <div class="overflow-x-auto rounded-xl border border-neutral-800">
            <table class="min-w-full divide-y divide-neutral-800">
                <thead class="bg-neutral-950">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-neutral-400 uppercase">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-neutral-400 uppercase">Pelanggan / Plat</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-neutral-400 uppercase">Jasa</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-neutral-400 uppercase">Sparepart</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-neutral-400 uppercase">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-neutral-900/40 divide-y divide-neutral-800">
                    <?php $__empty_1 = true; $__currentLoopData = $transaksiSelesai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-neutral-800/30 transition">
                            <td class="px-4 py-4 text-sm text-neutral-400"><?php echo e($t->tanggal_servis); ?></td>
                            <td class="px-4 py-4 text-sm text-white">
                                <span class="font-bold block"><?php echo e($t->kendaraan->pelanggan->nama_pelanggan); ?></span>
                                <span class="text-xs text-purple-400"><?php echo e($t->kendaraan->no_polisi); ?></span>
                            </td>
                            <td class="px-4 py-4 text-sm text-neutral-300">Rp <?php echo e(number_format($t->biaya_jasa, 0, ',', '.')); ?></td>
                            <td class="px-4 py-4 text-sm text-neutral-300">
                                <span class="block text-xs text-neutral-400"><?php echo e($t->nama_sparepart ?? '-'); ?></span>
                                Rp <?php echo e(number_format($t->biaya_sparepart, 0, ',', '.')); ?>

                            </td>
                            <td class="px-4 py-4 text-sm font-bold text-green-400">Rp <?php echo e(number_format($t->biaya_jasa + $t->biaya_sparepart, 0, ',', '.')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-neutral-500">Belum ada transaksi berstatus 'Selesai' untuk dibukukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html><?php /**PATH D:\laragon\www\assignment-bengkel\resources\views/servis/laporan.blade.php ENDPATH**/ ?>