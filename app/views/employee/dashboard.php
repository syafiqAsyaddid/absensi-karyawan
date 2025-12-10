<div x-data="employeeDashboard()" class="min-h-screen bg-gray-50/50 font-sans pb-12">
    
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-30">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-2">
                    <div class="bg-blue-600 text-white p-1.5 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="font-bold text-xl text-gray-800 tracking-tight">Portal Karyawan</span>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden md:block text-right">
                        <p class="text-sm font-bold text-gray-700"><?= $data['user']['nama']; ?></p>
                        <p class="text-xs text-gray-500"><?= $data['user']['jabatan']; ?></p>
                    </div>
                    <a href="<?= BASEURL; ?>/auth/logout" class="text-gray-500 hover:text-red-600 transition bg-gray-100 hover:bg-red-50 p-2 rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="space-y-6">
                
                <div class="bg-white rounded-2xl shadow-sm border border-blue-100 overflow-hidden relative">
                    <div class="absolute top-0 right-0 p-4">
                        <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-full">Bulan Ini</span>
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-gray-500 font-medium mb-1">Estimasi Gaji Bersih</p>
                        <div class="flex items-center gap-3">
                            <h2 class="text-3xl font-bold text-gray-800 tracking-tight" x-show="showSalary">
                                Rp <?= number_format($data['salary']['final']); ?>
                            </h2>
                            <h2 class="text-3xl font-bold text-gray-400 tracking-tight" x-show="!showSalary">
                                Rp •••• •••
                            </h2>
                            
                            <button @click="showSalary = !showSalary" class="text-gray-400 hover:text-blue-600 transition">
                                <svg x-show="!showSalary" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <svg x-show="showSalary" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 011.591-3.591M6.228 6.228A10.45 10.45 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.447 10.447 0 01-1.897 3.633M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"></path></svg>
                            </button>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-100" x-show="showSalary" x-transition>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-500">Gaji Pokok</span>
                                <span class="font-medium">Rp <?= number_format($data['salary']['base']); ?></span>
                            </div>
                            <div class="flex justify-between text-sm text-red-500">
                                <span>Potongan (<?= $data['salary']['alpha_count']; ?>x Alpha)</span>
                                <span>- Rp <?= number_format($data['salary']['deduction']); ?></span>
                            </div>
                            <p class="text-xs text-gray-400 mt-2 italic">*Potongan 5% setiap kelipatan 3x Alpha.</p>
                        </div>
                    </div>
                </div>

                <a href="https://wa.me/6282120114045?text=Halo%20Admin,%20saya%20<?= $data['user']['nama']; ?>%20izin%20tidak%20masuk%20kerja%20pada%20tanggal... karena..." 
                   target="_blank"
                   class="flex items-center justify-center gap-3 w-full bg-green-500 hover:bg-green-600 text-white p-4 rounded-2xl shadow-lg shadow-green-500/30 transition transform hover:-translate-y-1">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span class="font-bold">Ajukan Izin via WhatsApp</span>
                </a>

                <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100">
                    <h3 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
                        <span>📢</span> Update Tim Hari Ini
                    </h3>
                    <div class="space-y-3">
                        <?php if(empty($data['team_updates'])): ?>
                            <p class="text-sm text-gray-500 italic">Semua rekan kerja hadir hari ini.</p>
                        <?php else: ?>
                            <?php foreach($data['team_updates'] as $log): 
                                $badge = "bg-gray-100 text-gray-600";
                                if($log['status']=='Sakit') $badge = "bg-blue-100 text-blue-700";
                                if($log['status']=='Izin') $badge = "bg-orange-100 text-orange-700";
                                if($log['status']=='Alpha') $badge = "bg-red-100 text-red-700";
                            ?>
                            <div class="flex items-center justify-between text-sm bg-white p-3 rounded-lg shadow-sm">
                                <div>
                                    <p class="font-bold text-gray-700"><?= $log['nama']; ?></p>
                                    <p class="text-xs text-gray-400"><?= $log['jabatan']; ?></p>
                                </div>
                                <span class="<?= $badge; ?> px-2 py-1 rounded text-xs font-bold"><?= $log['status']; ?></span>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-2 space-y-6">
                
                <?php
                    $total_h = 0; $total_i = 0; $total_a = 0;
                    foreach($data['history'] as $h) {
                        if($h['status'] == 'Hadir') $total_h++;
                        if($h['status'] == 'Izin' || $h['status'] == 'Sakit') $total_i++;
                        if($h['status'] == 'Alpha') $total_a++;
                    }
                ?>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm text-center">
                        <p class="text-xs text-gray-400 font-bold uppercase">Hadir</p>
                        <p class="text-2xl font-bold text-green-600"><?= $total_h; ?></p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm text-center">
                        <p class="text-xs text-gray-400 font-bold uppercase">Izin/Sakit</p>
                        <p class="text-2xl font-bold text-orange-500"><?= $total_i; ?></p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm text-center">
                        <p class="text-xs text-gray-400 font-bold uppercase">Alpha</p>
                        <p class="text-2xl font-bold text-red-500"><?= $total_a; ?></p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Riwayat Kehadiran (30 Hari Terakhir)</h3>
                    
                    <?php if(empty($data['history'])): ?>
                        <div class="text-center py-10">
                            <p class="text-gray-400">Belum ada data absensi.</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-3">
                            <?php foreach($data['history'] as $row): 
                                $statusColor = "bg-gray-100 text-gray-600";
                                $borderLeft = "border-l-4 border-gray-300";
                                if($row['status'] == 'Hadir') { $statusColor = "bg-green-50 text-green-700"; $borderLeft = "border-l-4 border-green-500"; }
                                if($row['status'] == 'Sakit') { $statusColor = "bg-blue-50 text-blue-700"; $borderLeft = "border-l-4 border-blue-500"; }
                                if($row['status'] == 'Izin') { $statusColor = "bg-orange-50 text-orange-700"; $borderLeft = "border-l-4 border-orange-500"; }
                                if($row['status'] == 'Alpha') { $statusColor = "bg-red-50 text-red-700"; $borderLeft = "border-l-4 border-red-500"; }
                            ?>
                            <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition <?= $borderLeft; ?>">
                                <div class="flex items-center gap-4">
                                    <div class="text-center">
                                        <p class="text-xs font-bold text-gray-400 uppercase"><?= date('M', strtotime($row['tanggal'])); ?></p>
                                        <p class="text-xl font-bold text-gray-800"><?= date('d', strtotime($row['tanggal'])); ?></p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700"><?= date('l, d F Y', strtotime($row['tanggal'])); ?></p>
                                    </div>
                                </div>
                                <span class="<?= $statusColor; ?> px-3 py-1 rounded-full text-xs font-bold">
                                    <?= $row['status']; ?>
                                </span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </main>
</div>

<script>
    function employeeDashboard() {
        return {
            showSalary: false
        }
    }
</script>