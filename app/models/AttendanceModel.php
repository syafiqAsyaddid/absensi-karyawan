<?php
class AttendanceModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Ambil Absensi 1 User per Bulan (Untuk Tampilan Kalender Dashboard)
    public function getMonthlyAttendance($user_id, $month, $year) {
        $query = "SELECT * FROM attendance WHERE user_id = :uid AND MONTH(tanggal) = :m AND YEAR(tanggal) = :y";
        $this->db->query($query);
        $this->db->bind('uid', $user_id);
        $this->db->bind('m', $month);
        $this->db->bind('y', $year);
        return $this->db->resultSet();
    }

    // [BARU] Ambil Absensi SEMUA User per Bulan (Untuk Export PDF Matriks)
    public function getAllAttendanceByMonth($month, $year) {
        $query = "SELECT attendance.*, users.nama 
                  FROM attendance 
                  JOIN users ON attendance.user_id = users.id 
                  WHERE MONTH(tanggal) = :m AND YEAR(tanggal) = :y";
        
        $this->db->query($query);
        $this->db->bind('m', $month);
        $this->db->bind('y', $year);
        return $this->db->resultSet();
    }

    // Simpan Absensi (Sama seperti sebelumnya)
    public function setAttendance($data) {
        $this->db->query("SELECT id FROM attendance WHERE user_id = :uid AND tanggal = :tgl");
        $this->db->bind('uid', $data['user_id']);
        $this->db->bind('tgl', $data['tanggal']);
        $existing = $this->db->single();

        if($existing) {
            $query = "UPDATE attendance SET status = :st WHERE id = :id";
            $this->db->query($query);
            $this->db->bind('st', $data['status']);
            $this->db->bind('id', $existing['id']);
        } else {
            $query = "INSERT INTO attendance (user_id, tanggal, status) VALUES (:uid, :tgl, :st)";
            $this->db->query($query);
            $this->db->bind('uid', $data['user_id']);
            $this->db->bind('tgl', $data['tanggal']);
            $this->db->bind('st', $data['status']);
        }
        return $this->db->execute();
    }

    // Hitung jumlah karyawan yang sudah absen per tanggal dalam satu bulan
    public function getDailyTotalAttendance($month, $year) {
        // Query ini menghitung berapa user unik yang ada di tabel attendance per tanggal
        $query = "SELECT tanggal, COUNT(DISTINCT user_id) as total_absen 
                  FROM attendance 
                  WHERE MONTH(tanggal) = :m AND YEAR(tanggal) = :y 
                  GROUP BY tanggal";
        
        $this->db->query($query);
        $this->db->bind('m', $month);
        $this->db->bind('y', $year);
        return $this->db->resultSet();
    }
    // [TAMBAHAN] Ambil Riwayat Absensi Spesifik User (Limit 30 hari terakhir)
    public function getAttendanceByUser($user_id, $limit = 30) {
        $this->db->query("SELECT * FROM attendance WHERE user_id = :id ORDER BY tanggal DESC LIMIT :limit");
        $this->db->bind('id', $user_id);
        $this->db->bind('limit', $limit);
        return $this->db->resultSet();
    }

    // [TAMBAHAN] Hitung Gaji & Potongan (5% per 3 Alpha)
    public function getSalaryReport($user_id, $base_salary) {
        // Hitung total Alpha
        $this->db->query("SELECT COUNT(*) as total FROM attendance WHERE user_id = :id AND status = 'Alpha'");
        $this->db->bind('id', $user_id);
        $res = $this->db->single();
        $alpha_count = $res['total'];

        // Logic Potongan
        $multiplier = floor($alpha_count / 3); // Kelipatan 3
        $percent_cut = $multiplier * 0.05; // 5% per kelipatan
        $deduction = $base_salary * $percent_cut;
        $final_salary = $base_salary - $deduction;

        return [
            'base' => $base_salary,
            'alpha_count' => $alpha_count,
            'multiplier' => $multiplier, // Berapa kali kena hukuman
            'deduction' => $deduction,
            'final' => $final_salary
        ];
    }

    // [TAMBAHAN] Widget: Siapa saja yang Izin/Sakit/Alpha hari ini? (Untuk info rekan kerja)
    public function getTodayUpdates() {
        $today = date('Y-m-d');
        // Hanya ambil yang TIDAK Hadir (Sakit, Izin, Alpha)
        $query = "SELECT u.nama, u.jabatan, a.status 
                  FROM users u 
                  JOIN attendance a ON u.id = a.user_id 
                  WHERE a.tanggal = :today AND a.status != 'Hadir' AND u.role = 'karyawan'";
        
        $this->db->query($query);
        $this->db->bind('today', $today);
        return $this->db->resultSet();
    }
}