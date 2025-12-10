<?php
class AdminController extends Controller {
    public function index() {
        if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') { 
            header('Location: '.BASEURL.'/auth'); 
            exit; 
        }

        $data['admin_profile'] = $this->model('UserModel')->getUserById($_SESSION['user_id']);

        $data['title'] = 'Dashboard Admin';
        
        // 1. Ambil Data Karyawan
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $data['employees'] = $this->model('UserModel')->searchEmployees($_GET['q']);
            $data['search_keyword'] = $_GET['q'];
        } else {
            $data['employees'] = $this->model('UserModel')->getAllEmployees();
            $data['search_keyword'] = '';
        }

        // Safety check array
        if (!is_array($data['employees'])) $data['employees'] = [];

        // 2. Filter Tanggal
        $data['selected_month'] = isset($_GET['m']) ? $_GET['m'] : date('m');
        $data['selected_year'] = isset($_GET['y']) ? $_GET['y'] : date('Y');

        // 3. Logic Kalender Monitoring
        // [INI BAGIAN YANG HILANG SEBELUMNYA]
        // Kita ambil ulang semua karyawan untuk menghitung totalnya (tanpa filter search)
        $allEmp = $this->model('UserModel')->getAllEmployees();
        $data['total_employees_count'] = is_array($allEmp) ? count($allEmp) : 0; 

        // Ambil Data Agregat Harian
        $dailyRaw = $this->model('AttendanceModel')->getDailyTotalAttendance($data['selected_month'], $data['selected_year']);
        $data['calendar_status'] = [];
        if(is_array($dailyRaw)){
            foreach($dailyRaw as $row) {
                $data['calendar_status'][$row['tanggal']] = $row['total_absen'];
            }
        }

        // 4. Hitung Statistik Ringkasan
        $allAttendance = $this->model('AttendanceModel')->getAllAttendanceByMonth($data['selected_month'], $data['selected_year']);
        $data['total_hadir'] = 0;
        $data['total_izin'] = 0;
        $data['total_alpha'] = 0;
        
        if(is_array($allAttendance)){
            foreach($allAttendance as $row) {
                if($row['status'] == 'Hadir') $data['total_hadir']++;
                if($row['status'] == 'Izin' || $row['status'] == 'Sakit') $data['total_izin']++;
                if($row['status'] == 'Alpha') $data['total_alpha']++;
            }
        }

        // 5. Logic Simpan Absensi Massal
        if(isset($_POST['absen_bulk'])) {
            $tanggal = $_POST['tanggal'];
            $attendanceData = $_POST['attendance'] ?? [];

            foreach($attendanceData as $uid => $status) {
                $payload = ['user_id' => $uid, 'tanggal' => $tanggal, 'status' => $status];
                $this->model('AttendanceModel')->setAttendance($payload);
            }
            $m = date('m', strtotime($tanggal));
            $y = date('Y', strtotime($tanggal));
            header("Location: " . BASEURL . "/admin?tab=absensi&m=$m&y=$y");
            exit;
        }

        // Logic Save/Delete User
        if(isset($_POST['action_type'])) { $this->save(); }
        if(isset($_GET['delete_id'])) { $this->delete($_GET['delete_id']); }

        $this->view('layouts/header', $data);
        $this->view('admin/dashboard', $data);
        $this->view('layouts/footer');
    }

    // [BARU] Export PDF Rekap Semua Karyawan
    public function export_recap() {
        if($_SESSION['role'] != 'admin') exit;
        
        $m = $_GET['m'];
        $y = $_GET['y'];
        
        $data['month'] = $m;
        $data['year'] = $y;
        
        // Ambil Semua Karyawan
        $data['employees'] = $this->model('UserModel')->getAllEmployees();
        
        // Ambil Data Absensi Mentah Semua Orang
        $rawAttendance = $this->model('AttendanceModel')->getAllAttendanceByMonth($m, $y);
        
        // Susun Data menjadi Array Matriks: $data[user_id][tanggal] = status
        $matrix = [];
        foreach($rawAttendance as $row) {
            $tgl = (int)date('d', strtotime($row['tanggal'])); // Ambil tanggalnya saja (1-31)
            $matrix[$row['user_id']][$tgl] = $row['status'];
        }
        $data['matrix'] = $matrix;

        $this->view('admin/print_recap', $data);
    }
    
    // Fungsi Save & Delete tetap ada (disingkat disini)
    // Fungsi Simpan User (Tambah & Edit)
    public function save() {
        if($_SESSION['role'] != 'admin') { header('Location: '.BASEURL.'/auth'); exit; }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Cek Action Type
            if($_POST['action_type'] == 'add') {
                if($this->model('UserModel')->addUser($_POST)) {
                    header('Location: '.BASEURL.'/admin?tab=karyawan');
                    exit;
                }
            } elseif ($_POST['action_type'] == 'edit') {
                if($this->model('UserModel')->updateUser($_POST)) {
                    header('Location: '.BASEURL.'/admin?tab=karyawan');
                    exit;
                }
            }
        }
    }
    public function delete($id) { $this->model('UserModel')->deleteUser($id); header('Location: '.BASEURL.'/admin?tab=karyawan'); }
}