<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelanggan - Bengkel Maju Motor</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-neutral-950 p-8 min-h-screen text-gray-100">
    <div class="max-w-4xl mx-auto bg-neutral-900 p-6 rounded-2xl shadow-xl border border-purple-900/40">
        
        <!-- Menu Navigasi Gabungan -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6 border-b border-purple-900/60 pb-4">
            <div class="flex gap-4">
                <a href="<?php echo e(route('pelanggan.index')); ?>" class="text-purple-400 font-bold border-b-2 border-purple-400 pb-1 text-sm">Data Pelanggan</a>
                <a href="<?php echo e(route('kendaraan.index')); ?>" class="text-neutral-400 hover:text-purple-400 font-medium text-sm transition">Data Kendaraan</a>
                <a href="<?php echo e(route('servis.index')); ?>" class="text-neutral-400 hover:text-purple-400 font-medium text-sm transition">Pendaftaran Servis</a>
            </div>
            <div>
                <a href="<?php echo e(route('dashboard')); ?>" class="bg-purple-900 hover:bg-purple-800 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">🏠 Menu Utama</a>
            </div>
        </div>

        <h1 class="text-2xl font-bold mb-6 text-white border-b border-neutral-800 pb-2">Manajemen Pelanggan</h1>

        <?php if(session('success')): ?>
            <div class="bg-purple-950/80 border border-purple-500 text-purple-200 px-4 py-3 rounded-xl mb-4 text-sm">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('pelanggan.store')); ?>" method="POST" class="mb-8 bg-neutral-950/60 p-5 rounded-xl border border-purple-900/40">
            <?php echo csrf_field(); ?>
            <h2 class="text-md font-bold mb-4 text-purple-300">Tambah Pelanggan Baru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 uppercase">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" required class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 focus:border-purple-500 focus:outline-none text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 uppercase">No. Telepon</label>
                    <input type="text" name="telepon" required class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 focus:border-purple-500 focus:outline-none text-sm">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-xs font-semibold text-neutral-300 uppercase">Alamat</label>
                <textarea name="alamat" rows="2" class="mt-1 block w-full rounded-lg bg-neutral-900 border border-purple-900/60 text-white p-2.5 focus:border-purple-500 focus:outline-none text-sm"></textarea>
            </div>
            <button type="submit" class="bg-purple-600 text-white px-5 py-2 rounded-lg hover:bg-purple-700 text-sm font-bold transition cursor-pointer shadow-md shadow-purple-900/20">Simpan Pelanggan</button>
        </form>

        <h2 class="text-md font-bold mb-4 text-purple-300">Daftar Pelanggan</h2>
        <div class="overflow-x-auto rounded-xl border border-neutral-800">
            <table class="min-w-full divide-y divide-neutral-800">
                <thead class="bg-neutral-950">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-neutral-400 uppercase tracking-wider border-b border-neutral-800">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-neutral-400 uppercase tracking-wider border-b border-neutral-800">Nama Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-neutral-400 uppercase tracking-wider border-b border-neutral-800">No. Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-neutral-400 uppercase tracking-wider border-b border-neutral-800">Alamat</th>
                    </tr>
                </thead>
                <tbody class="bg-neutral-900/40 divide-y divide-neutral-800">
                    <?php $__empty_1 = true; $__currentLoopData = $pelanggans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-neutral-800/30 transition">
                            <td class="px-6 py-4 text-sm text-neutral-400"><?php echo e($p->id); ?></td>
                            <td class="px-6 py-4 text-sm font-bold text-white"><?php echo e($p->nama_pelanggan); ?></td>
                            <td class="px-6 py-4 text-sm text-neutral-300"><?php echo e($p->telepon); ?></td>
                            <td class="px-6 py-4 text-sm text-neutral-400"><?php echo e($p->alamat ?? '-'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-neutral-500">Belum ada data pelanggan di database.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html><?php /**PATH D:\laragon\www\assignment-bengkel\resources\views/pelanggan/index.blade.php ENDPATH**/ ?>