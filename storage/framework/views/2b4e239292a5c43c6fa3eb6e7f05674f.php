<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Bengkel Maju Motor</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-neutral-950 p-8 min-h-screen text-gray-100 flex items-center justify-center">
    <div class="max-w-4xl w-full bg-neutral-900 p-8 rounded-2xl shadow-2xl border border-purple-900/40 text-center">
        <h1 class="text-4xl font-extrabold mb-2 text-white tracking-wide">Bengkel Maju Motor</h1>
        <p class="text-purple-300 font-medium mb-4">Sistem Manajemen Pelanggan, Kendaraan, dan Antrean Servis Terpadu</p>

        <!-- Baris Informasi User Aktif & Tombol Logout -->
        <div class="mb-10 flex justify-center items-center gap-3">
            <span class="text-xs bg-neutral-950 text-purple-400 border border-purple-900/60 px-3 py-1.5 rounded-lg font-bold">
                👤 User Aktif: <?php echo e(Auth::user()->name); ?>

            </span>
            <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="bg-red-950 hover:bg-red-900 text-red-400 border border-red-900/60 px-3 py-1.5 rounded-lg text-xs font-bold transition cursor-pointer">
                    🚪 Keluar Aplikasi
                </button>
            </form>
        </div>

        <!-- Grid Menu Utama Berdasarkan Aktor -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card Pelanggan (Akses: Admin) -->
            <a href="<?php echo e(route('pelanggan.index')); ?>" class="relative block p-6 bg-neutral-950/50 hover:bg-purple-950/30 border border-purple-900/40 hover:border-purple-500 rounded-xl transition duration-300 group">
                <span class="absolute top-3 right-3 bg-purple-700 text-white text-[10px] font-black px-2 py-0.5 rounded-md tracking-wider">ADMIN</span>
                <div class="text-4xl mb-3 group-hover:scale-110 transition duration-300">👥</div>
                <h2 class="text-xl font-bold text-white mb-2 group-hover:text-purple-400 transition">Data Pelanggan</h2>
                <p class="text-xs text-neutral-400 leading-relaxed">Kelola informasi data diri pemilik kendaraan.</p>
            </a>

            <!-- Card Kendaraan (Akses: Admin) -->
            <a href="<?php echo e(route('kendaraan.index')); ?>" class="relative block p-6 bg-neutral-950/50 hover:bg-purple-950/30 border border-purple-900/40 hover:border-purple-500 rounded-xl transition duration-300 group">
                <span class="absolute top-3 right-3 bg-purple-700 text-white text-[10px] font-black px-2 py-0.5 rounded-md tracking-wider">ADMIN</span>
                <div class="text-4xl mb-3 group-hover:scale-110 transition duration-300">🚗</div>
                <h2 class="text-xl font-bold text-white mb-2 group-hover:text-purple-400 transition">Data Kendaraan</h2>
                <p class="text-xs text-neutral-400 leading-relaxed">Registrasi spesifikasi & plat nomor kendaraan.</p>
            </a>

            <!-- Card Servis (Akses: Kasir & Mekanik) -->
            <a href="<?php echo e(route('servis.index')); ?>" class="relative block p-6 bg-neutral-950/50 hover:bg-purple-950/30 border border-purple-900/40 hover:border-purple-500 rounded-xl transition duration-300 group">
                <span class="absolute top-3 right-3 bg-purple-600 text-white text-[10px] font-black px-2 py-0.5 rounded-md tracking-wider">KASIR / MEKANIK</span>
                <div class="text-4xl mb-3 group-hover:scale-110 transition duration-300">🛠️</div>
                <h2 class="text-xl font-bold text-white mb-2 group-hover:text-purple-400 transition">Pendaftaran Servis</h2>
                <p class="text-xs text-neutral-400 leading-relaxed">Catat antrean (Kasir) & update status (Mekanik).</p>
            </a>
        </div>
    </div>
</body>
</html><?php /**PATH D:\laragon\www\assignment-bengkel\resources\views/dashboard.blade.php ENDPATH**/ ?>