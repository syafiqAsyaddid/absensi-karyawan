<div class="min-h-screen flex items-center justify-center bg-secondary">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-blue-100">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-primary">Absensi PT Xyz</h1>
            <p class="text-gray-500">Masuk untuk mengelola absensi</p>
        </div>
        <form action="<?= BASEURL; ?>/auth/process" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" required class="mt-1 w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required class="mt-1 w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition">
            </div>
            <button type="submit" class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-300 shadow-lg shadow-blue-500/30">
                MASUK SEKARANG
            </button>
        </form>
    </div>
</div>