<?php
class EmployeeController extends Controller {
    public function index() {
        // 1. Cek Sesi Karyawan
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'karyawan') {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $data['title'] = 'Dashboard Saya';

        // 2. Ambil Data Diri (Profile)
        $data['user'] = $this->model('UserModel')->getUserById($userId);

        // 3. Ambil Riwayat Absensi
        $data['history'] = $this->model('AttendanceModel')->getAttendanceByUser($userId);

        // 4. Hitung Gaji Realtime
        $data['salary'] = $this->model('AttendanceModel')->getSalaryReport($userId, $data['user']['gaji_pokok']);

        // 5. Info Rekan Kerja (Opsional: Siapa yg tidak masuk hari ini)
        $data['team_updates'] = $this->model('AttendanceModel')->getTodayUpdates();

        $this->view('layouts/header', $data);
        $this->view('employee/dashboard', $data);
        $this->view('layouts/footer');
    }
}