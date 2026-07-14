<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Bengkel Maju Motor</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-neutral-950 min-h-screen text-gray-100 flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-neutral-900 p-8 rounded-2xl shadow-2xl border border-purple-900/40">
        <h2 class="text-3xl font-extrabold text-center text-white mb-2">Sign In</h2>
        <p class="text-center text-purple-300 text-sm mb-6">Aplikasi Bengkel Maju Motor</p>

        <?php if(session('success')): ?>
            <div class="bg-green-950/80 border border-green-500 text-green-200 px-4 py-2.5 rounded-lg text-xs mb-4"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="bg-red-950/80 border border-red-500 text-red-200 px-4 py-2.5 rounded-lg text-xs mb-4"><?php echo e($errors->first()); ?></div>
        <?php endif; ?>

        <form action="<?php echo e(route('login')); ?>" method="POST" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-xs font-bold text-neutral-300 uppercase">Email Address</label>
                <input type="email" name="email" required class="mt-1 block w-full rounded-lg bg-neutral-950 border border-purple-900/60 text-white p-2.5 text-sm focus:border-purple-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-neutral-300 uppercase">Password</label>
                <input type="password" name="password" required class="mt-1 block w-full rounded-lg bg-neutral-950 border border-purple-900/60 text-white p-2.5 text-sm focus:border-purple-500 focus:outline-none">
            </div>
            <button type="submit" class="w-full bg-purple-600 text-white py-2.5 rounded-lg hover:bg-purple-700 text-sm font-bold transition shadow-md shadow-purple-900/20">Masuk Aplikasi</button>
        </form>
        <p class="text-center text-xs text-neutral-400 mt-4">Belum punya akun? <a href="<?php echo e(route('register')); ?>" class="text-purple-400 font-bold hover:underline">Daftar di sini</a></p>
    </div>
</body>
</html><?php /**PATH D:\laragon\www\assignment-bengkel\resources\views/auth/login.blade.php ENDPATH**/ ?>