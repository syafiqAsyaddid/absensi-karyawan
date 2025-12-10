<div x-data="karyawanApp()" class="flex min-h-screen bg-gray-50 font-sans">
    
    <aside class="w-64 bg-white border-r border-gray-100 fixed inset-y-0 left-0 z-30 transition-transform duration-300 transform md:translate-x-0"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        
        <div class="p-8 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-blue-700 tracking-tight">Admin Panel</h2>
            
            <button @click="sidebarOpen = false" class="md:hidden text-gray-500 hover:text-red-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <nav class="flex-1 px-4 space-y-3">
            <a href="#" @click="tab = 'karyawan'; sidebarOpen = false" 
               :class="tab==='karyawan' ? 'bg-blue-50 text-blue-700 shadow-sm ring-1 ring-blue-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900'" 
               class="flex items-center px-4 py-3.5 rounded-xl font-semibold transition-all duration-200 group">
                <svg class="w-5 h-5 mr-3" :class="tab==='karyawan' ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Data Karyawan
            </a>

            <a href="#" @click="tab = 'absensi'; sidebarOpen = false" 
               :class="tab==='absensi' ? 'bg-blue-50 text-blue-700 shadow-sm ring-1 ring-blue-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900'" 
               class="flex items-center px-4 py-3.5 rounded-xl font-semibold transition-all duration-200 group">
                <svg class="w-5 h-5 mr-3" :class="tab==='absensi' ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Kelola Kehadiran
            </a>

            <a href="<?= BASEURL; ?>/auth/logout" class="flex items-center px-4 py-3.5 text-red-500 hover:bg-red-50 hover:text-red-600 rounded-xl font-semibold transition-all duration-200 mt-auto group">
                <div class="w-1 h-6 bg-red-500 rounded-full mr-3 group-hover:h-4 transition-all duration-200"></div>
                Keluar
            </a>
        </nav>
    </aside>

    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity 
         class="fixed inset-0 bg-black/50 z-20 md:hidden"></div>

    <main class="ml-0 md:ml-64 flex-1 p-8 overflow-y-auto">
        
        <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-4 sm:px-8 sticky top-0 z-20 shadow-sm mb-6 rounded-[12px]">
            
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="md:hidden text-gray-500 hover:text-blue-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <div class="flex items-center gap-2 text-gray-500 text-sm font-medium">
                    <span class="hidden sm:inline">Dashboard</span>
                    <svg class="w-4 h-4 hidden sm:inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="text-blue-600">Admin Panel</span>
                </div>
            </div>

            <div @click="showProfileModal = true" class="flex items-center gap-3 cursor-pointer group p-1.5 pr-3 rounded-full hover:bg-gray-50 transition border border-transparent hover:border-gray-200">
                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-blue-600 to-blue-400 flex items-center justify-center text-white font-bold shadow-md">
                    <?= substr($data['admin_profile']['nama'], 0, 1); ?>
                </div>
                <div class="hidden md:block text-right leading-tight">
                    <p class="text-sm font-bold text-gray-700"><?= $data['admin_profile']['nama']; ?></p>
                    </div>
            </div>
        </header>

        <div x-show="tab === 'karyawan'" x-transition.opacity.duration.300ms>
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Manajemen Karyawan</h2>
            </div>

            <?php 
                $totalKaryawan = count($data['employees']);
                $totalGaji = 0;
                foreach($data['employees'] as $e) $totalGaji += $e['gaji_pokok'];
                $displayGaji = ($totalGaji >= 1000000) ? round($totalGaji/1000000, 1) . " Juta" : number_format($totalGaji);
            ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 flex items-center gap-5 transition-all duration-300 hover:shadow-lg hover:shadow-blue-100 hover:border-blue-200 hover:-translate-y-1 cursor-pointer group">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 font-bold text-xl transition-colors duration-300 group-hover:bg-blue-600 group-hover:text-white group-hover:shadow-md">
                        👥
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 transition-colors duration-300 group-hover:text-blue-600">Total Karyawan</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?= $totalKaryawan; ?> <span class="text-sm font-normal text-gray-400 group-hover:text-gray-500">Item</span></h3>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 flex items-center gap-5 transition-all duration-300 hover:shadow-lg hover:shadow-blue-100 hover:border-blue-200 hover:-translate-y-1 cursor-pointer group">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 font-bold text-xl transition-colors duration-300 group-hover:bg-blue-600 group-hover:text-white group-hover:shadow-md">
                        💸
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 transition-colors duration-300 group-hover:text-blue-600">Total Gaji</p>
                        <h3 class="text-2xl font-bold text-gray-800">Rp <?= $displayGaji; ?></h3>
                    </div>
                </div>

            </div>
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row gap-4 justify-between items-center bg-white">
                    <form action="<?= BASEURL; ?>/admin" method="GET" class="relative w-full sm:w-72">
                        <button type="submit" class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 hover:text-blue-500 transition">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </button>
                        <input type="text" name="q" value="<?= isset($data['search_keyword']) ? $data['search_keyword'] : ''; ?>" placeholder="Cari karyawan..." class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none text-sm transition shadow-sm" autocomplete="off">
                    </form>
                    <button @click="openAddModal()" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg shadow-blue-600/30 hover:bg-blue-700 transition font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Baru
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-blue-50/50 text-blue-900 text-xs uppercase tracking-wider font-semibold">
                                <th class="p-5">Nama</th>
                                <th class="p-5">Jabatan</th>
                                <th class="p-5">Username</th>
                                <th class="p-5">Gaji Pokok</th>
                                <th class="p-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php foreach($data['employees'] as $emp): ?>
                            <tr class="hover:bg-blue-50/30 transition duration-150 group">
                                <td class="p-5">
                                    <div class="font-bold text-gray-800"><?= $emp['nama']; ?></div>
                                </td>
                                <td class="p-5">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-blue-600 text-white">
                                        <?= $emp['jabatan']; ?>
                                    </span>
                                </td>
                                <td class="p-5 text-gray-500 text-sm"><?= $emp['username']; ?></td>
                                <td class="p-5 font-medium text-blue-900">
                                    Rp <?= number_format($emp['gaji_pokok']); ?>
                                </td>
                                <td class="p-5 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="javascript:void(0)" 
                                        @click="openEditModal(<?= htmlspecialchars(json_encode($emp), ENT_QUOTES, 'UTF-8') ?>)"
                                        class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center gap-1 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            Edit
                                        </a>

                                        <a href="<?= BASEURL; ?>/admin/delete/<?= $emp['id']; ?>" onclick="return confirm('Hapus karyawan ini?')" class="text-red-400 hover:text-red-600 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div x-show="tab === 'absensi'" x-cloak>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Kelola Kehadiran</h2>
            </div>
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
                <form action="<?= BASEURL; ?>/admin" method="GET" class="flex flex-col md:flex-row gap-4 items-end justify-between">
                    <input type="hidden" name="tab" value="absensi">
                    
                    <div class="flex gap-4 w-full md:w-auto flex-1">
                        <div class="w-full md:w-1/2">
                            <label class="block text-sm font-bold text-gray-600 mb-2">Bulan</label>
                            <select name="m" class="w-full border border-gray-200 rounded-lg p-2.5 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 outline-none transition" onchange="this.form.submit()">
                                <?php for($m=1; $m<=12; $m++): ?>
                                    <option value="<?= $m; ?>" <?= ($data['selected_month'] == $m) ? 'selected' : ''; ?>>
                                        <?= date('F', mktime(0, 0, 0, $m, 10)); ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="w-full md:w-1/2">
                            <label class="block text-sm font-bold text-gray-600 mb-2">Tahun</label>
                            <select name="y" class="w-full border border-gray-200 rounded-lg p-2.5 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 outline-none transition" onchange="this.form.submit()">
                                <?php for($y=date('Y'); $y>=2020; $y--): ?>
                                    <option value="<?= $y; ?>" <?= ($data['selected_year'] == $y) ? 'selected' : ''; ?>><?= $y; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="w-full md:w-auto">
                        <a href="<?= BASEURL; ?>/admin/export_recap?m=<?= $data['selected_month']; ?>&y=<?= $data['selected_year']; ?>" 
                           target="_blank"
                           class="flex items-center justify-center gap-2 bg-red-600 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-red-700 transition shadow-lg shadow-red-600/30 w-full whitespace-nowrap transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Export Rekap (PDF)
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mt-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <h3 class="text-lg font-bold text-gray-700">
                        Status Penginputan: <span class="text-blue-600"><?= date("F Y", mktime(0, 0, 0, $data['selected_month'], 1, $data['selected_year'])); ?></span>
                    </h3>
                    
                    <div class="flex gap-3 text-xs font-medium bg-gray-50 p-2 rounded-lg">
                        <span class="flex items-center gap-1">
                            <span class="w-3 h-3 rounded-full bg-green-500 border border-green-600"></span> 
                            Lengkap (<?= $data['total_employees_count']; ?>/<?= $data['total_employees_count']; ?>)
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="w-3 h-3 rounded-full bg-yellow-400 border border-yellow-500"></span> 
                            Belum Lengkap
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="w-3 h-3 rounded-full bg-gray-200 border border-gray-300"></span> 
                            Kosong
                        </span>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-3">
                    <?php 
                        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $data['selected_month'], $data['selected_year']);
                        $today = date('Y-m-d');
                        $totalEmp = $data['total_employees_count'];
                        
                        for($d=1; $d<=$daysInMonth; $d++): 
                            $dateStr = sprintf("%04d-%02d-%02d", $data['selected_year'], $data['selected_month'], $d);
                            $isFuture = ($dateStr > $today);
                            
                            // Ambil jumlah yang sudah absen pada tanggal ini
                            $sudahAbsen = $data['calendar_status'][$dateStr] ?? 0;
                            
                            // LOGIKA WARNA PROGRES
                            $bgClass = "bg-white border-gray-200 hover:border-blue-500 hover:ring-1 hover:ring-blue-200";
                            $textClass = "text-gray-700";
                            $statusLabel = "";

                            if($sudahAbsen == 0) {
                                // Belum ada data sama sekali (Kosong)
                                $bgClass = "bg-gray-50 border-gray-200";
                                $statusLabel = "<span class='text-[10px] text-gray-400 mt-1 block'>Belum Input</span>";
                            } 
                            elseif($sudahAbsen < $totalEmp) {
                                // Data Masuk tapi Belum Semua (Kuning)
                                $bgClass = "bg-yellow-50 border-yellow-300 hover:border-yellow-500";
                                $textClass = "text-yellow-800";
                                $statusLabel = "<span class='text-[10px] font-bold text-yellow-700 mt-1 block'>⚠️ $sudahAbsen / $totalEmp</span>";
                            } 
                            elseif($sudahAbsen >= $totalEmp) {
                                // Lengkap Semua Karyawan (Hijau)
                                $bgClass = "bg-green-50 border-green-300 hover:border-green-500";
                                $textClass = "text-green-800";
                                $statusLabel = "<span class='text-[10px] font-bold text-green-700 mt-1 block'>✅ Lengkap</span>";
                            }
                            
                            if($isFuture) { 
                                $bgClass = "bg-gray-50 border-gray-100 opacity-40 cursor-not-allowed"; 
                                $statusLabel = "";
                            }
                    ?>
                        <div <?php if(!$isFuture): ?> @click="openAbsenModal('<?= $dateStr; ?>')" <?php endif; ?>
                            class="<?= $bgClass; ?> border rounded-xl p-3 min-h-[80px] flex flex-col justify-between transition relative cursor-pointer group">
                            
                            <span class="text-lg font-bold <?= $textClass; ?>"><?= $d; ?></span>
                            
                            <?php if(!$isFuture): ?>
                                <div>
                                    <?= $statusLabel; ?>
                                </div>
                                <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <div x-show="showAbsenModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/70 backdrop-blur-sm p-4" x-cloak>
                <div class="bg-white rounded-2xl w-full max-w-4xl shadow-2xl flex flex-col max-h-[90vh]" @click.away="showAbsenModal = false">
                    
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white rounded-t-2xl z-10">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Input Kehadiran Massal</h3>
                            <p class="text-sm text-blue-600 font-semibold mt-1">
                                Tanggal: <span x-text="absenForm.tanggalDisplay"></span>
                            </p>
                        </div>
                        <button @click="showAbsenModal = false" class="text-gray-400 hover:text-gray-600 bg-gray-100 p-2 rounded-full transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                    <form action="<?= BASEURL; ?>/admin" method="POST" class="flex flex-col flex-1 overflow-hidden">
                        <input type="hidden" name="absen_bulk" value="1">
                        <input type="hidden" name="tanggal" x-model="absenForm.tanggal">

                        <div class="px-6 py-3 bg-blue-50/50 flex justify-between items-center border-b border-blue-100">
                            <span class="text-xs font-bold text-blue-800 uppercase tracking-wide">Daftar Karyawan</span>
                            
                            <button type="button" onclick="document.querySelectorAll('input[value=Hadir]').forEach(r => r.checked = true)" class="text-xs font-bold text-blue-600 hover:text-blue-800 hover:underline cursor-pointer">
                                ✅ Set Semua "Hadir"
                            </button>
                        </div>

                        <div class="overflow-y-auto p-6 space-y-4 flex-1">
                            <?php foreach($data['employees'] as $emp): ?>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 rounded-xl border border-gray-100 hover:border-blue-200 hover:shadow-sm transition bg-white gap-4">
                                
                                <div class="flex items-center gap-3 min-w-[200px]">
                                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold text-sm border border-gray-200">
                                        <?= substr($emp['nama'], 0, 1); ?>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm"><?= $emp['nama']; ?></p>
                                        <p class="text-xs text-gray-500"><?= $emp['jabatan']; ?></p>
                                    </div>
                                </div>

                                <div class="flex bg-gray-50 p-1 rounded-lg border border-gray-200">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="attendance[<?= $emp['id']; ?>]" value="Hadir" class="peer sr-only" checked>
                                        <div class="px-4 py-2 rounded-md text-xs font-bold text-gray-500 peer-checked:bg-green-500 peer-checked:text-white peer-checked:shadow-sm transition">
                                            Hadir
                                        </div>
                                    </label>

                                    <label class="cursor-pointer">
                                        <input type="radio" name="attendance[<?= $emp['id']; ?>]" value="Izin" class="peer sr-only">
                                        <div class="px-4 py-2 rounded-md text-xs font-bold text-gray-500 peer-checked:bg-orange-500 peer-checked:text-white peer-checked:shadow-sm transition">
                                            Izin
                                        </div>
                                    </label>

                                    <label class="cursor-pointer">
                                        <input type="radio" name="attendance[<?= $emp['id']; ?>]" value="Alpha" class="peer sr-only">
                                        <div class="px-4 py-2 rounded-md text-xs font-bold text-gray-500 peer-checked:bg-red-500 peer-checked:text-white peer-checked:shadow-sm transition">
                                            Alpha
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="p-6 border-t border-gray-100 bg-gray-50 rounded-b-2xl">
                            <button type="submit" class="w-full bg-blue-600 text-white py-3.5 rounded-xl font-bold shadow-lg shadow-blue-600/20 hover:bg-blue-700 transition transform hover:-translate-y-0.5">
                                Simpan Semua Data Absensi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/60 backdrop-blur-sm p-4" x-cloak>
            <div class="bg-white rounded-2xl p-8 w-full max-w-lg shadow-2xl transform transition-all" @click.away="modalOpen = false">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800" x-text="isEdit ? 'Edit Data Karyawan' : 'Tambah Karyawan Baru'"></h3>
                    <button @click="modalOpen = false" class="text-gray-400 hover:text-gray-600 transition">✕</button>
                </div>
                
                <form action="<?= BASEURL; ?>/admin/save" method="POST" class="space-y-4">
                    <input type="hidden" name="action_type" x-model="form.action_type">
                    <input type="hidden" name="id" x-model="form.id">

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-500 uppercase">Nama Lengkap</label>
                            <input type="text" name="nama" x-model="form.nama" class="w-full border border-gray-200 p-2.5 rounded-lg focus:border-blue-500 outline-none transition" required>
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-500 uppercase">Username</label>
                            <input type="text" name="username" x-model="form.username" class="w-full border border-gray-200 p-2.5 rounded-lg focus:border-blue-500 outline-none transition" required>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-500 uppercase">Password</label>
                            <input type="password" name="password" class="w-full border border-gray-200 p-2.5 rounded-lg focus:border-blue-500 outline-none transition" 
                                   :placeholder="isEdit ? '(Biarkan kosong jika tetap)' : 'Masukan password...'" 
                                   :required="!isEdit">
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-500 uppercase">Gaji Pokok</label>
                            <input type="number" name="gaji" x-model="form.gaji" class="w-full border border-gray-200 p-2.5 rounded-lg focus:border-blue-500 outline-none transition" required>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-500 uppercase">Jenis Kelamin</label>
                            <select name="jk" x-model="form.jk" class="w-full border border-gray-200 p-2.5 rounded-lg focus:border-blue-500 outline-none bg-white transition">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-500 uppercase">Jabatan</label>
                            <input type="text" name="jabatan" x-model="form.jabatan" class="w-full border border-gray-200 p-2.5 rounded-lg focus:border-blue-500 outline-none transition">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase">Alamat</label>
                        <textarea name="alamat" x-model="form.alamat" rows="2" class="w-full border border-gray-200 p-2.5 rounded-lg focus:border-blue-500 outline-none transition"></textarea>
                    </div>

                    <div class="pt-2 flex gap-3">
                        <button type="button" @click="modalOpen = false" class="flex-1 bg-gray-100 text-gray-700 py-3 rounded-xl font-bold hover:bg-gray-200 transition">Batal</button>
                        <button type="submit" class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition transform hover:-translate-y-0.5">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
        <div x-show="showProfileModal" class="fixed inset-0 z-[70] flex items-center justify-center bg-gray-900/60 backdrop-blur-md p-4" x-cloak x-transition.opacity>
            <div class="bg-white rounded-3xl w-full max-w-sm shadow-2xl overflow-hidden transform transition-all scale-100 relative" @click.away="showProfileModal = false">
                
                <div class="h-32 bg-gradient-to-r from-blue-600 to-indigo-600 relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="absolute top-10 -left-10 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
                    
                    <button @click="showProfileModal = false" class="absolute top-4 right-4 text-white/70 hover:text-white bg-black/10 hover:bg-black/30 rounded-full p-1.5 transition backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="px-6 pb-8 relative">
                    <div class="flex justify-center -mt-16 mb-4">
                        <div class="w-32 h-32 rounded-full p-1.5 bg-white shadow-xl">
                            <div class="w-full h-full rounded-full bg-gray-100 flex items-center justify-center text-5xl font-bold text-blue-600 border border-gray-200">
                                <?= substr($data['admin_profile']['nama'], 0, 1); ?>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900"><?= $data['admin_profile']['nama']; ?></h3>
                        <div class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-bold mt-2 border border-blue-100">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            Administrator
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100 hover:border-blue-200 transition">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-gray-500 uppercase tracking-wide">Username</span>
                            </div>
                            <span class="font-semibold text-gray-700"><?= $data['admin_profile']['username']; ?></span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100 hover:border-green-200 transition">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-gray-500 uppercase tracking-wide">Gaji Pokok</span>
                            </div>
                            <span class="font-semibold text-green-700">Rp <?= number_format($data['admin_profile']['gaji_pokok']); ?></span>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                                <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Jenis Kelamin</p>
                                <p class="font-semibold text-gray-700"><?= ($data['admin_profile']['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan'; ?></p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                                <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Domisili</p>
                                <p class="font-semibold text-gray-700 truncate" title="<?= $data['admin_profile']['alamat']; ?>">
                                    <?= !empty($data['admin_profile']['alamat']) ? $data['admin_profile']['alamat'] : '-'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    function karyawanApp() {
        return {
            tab: new URLSearchParams(window.location.search).get('tab') || 'karyawan',
            modalOpen: false, isEdit: false,
            form: { id: '', action_type: 'add', nama: '', username: '', gaji: '', jk: 'L', jabatan: '', alamat: '' },

            // Modal Sidebar
            sidebarOpen: false,

            // Modal Profile
            showProfileModal: false,

            // Modal Absensi Bulk
            showAbsenModal: false,
            absenForm: { tanggal: '', tanggalDisplay: '' },

            // Fungsi Buka Modal Absen Massal
            openAbsenModal(dateStr) {
                this.absenForm.tanggal = dateStr;
                const dateObj = new Date(dateStr);
                this.absenForm.tanggalDisplay = dateObj.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                
                // Reset semua radio button ke 'Hadir' saat modal dibuka (opsional, UX standar)
                setTimeout(() => {
                    document.querySelectorAll('input[value=Hadir]').forEach(r => r.checked = true);
                }, 100);

                this.showAbsenModal = true;
            },

            // Fungsi Tambah/Edit User
            openAddModal() {
                this.isEdit = false;
                this.form = { id: '', action_type: 'add', nama: '', username: '', gaji: '', jk: 'L', jabatan: '', alamat: '' };
                this.modalOpen = true;
            },
            openEditModal(data) {
                this.isEdit = true;
                // Mapping data dari PHP ke Form Alpine
                this.form = {
                    id: data.id, 
                    action_type: 'edit', 
                    nama: data.nama, 
                    username: data.username,
                    // Pastikan gaji dikonversi ke angka/string yang benar
                    gaji: data.gaji_pokok, 
                    jk: data.jenis_kelamin, 
                    jabatan: data.jabatan, 
                    alamat: data.alamat
                };
                this.modalOpen = true;
            },
        }
    }
</script>