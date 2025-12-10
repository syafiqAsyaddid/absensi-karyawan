<footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-6xl mx-auto px-4 py-6">
            <p class="text-center text-gray-500 text-sm">
                &copy; <?= date('Y'); ?> Sistem Absensi & Penggajian. All rights reserved.
            </p>
        </div>
    </footer>

    <script>
        // Contoh: Hilangkan notifikasi setelah 3 detik
        setTimeout(function() {
            const alert = document.querySelector('.alert');
            if(alert) alert.style.display = 'none';
        }, 3000);
    </script>
</body>
</html>