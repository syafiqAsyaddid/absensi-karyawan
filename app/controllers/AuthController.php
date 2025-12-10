<?php
class AuthController extends Controller {
    
    // Tampilkan Halaman Login
    public function index() {
        // Jika sudah login, lempar ke dashboard sesuai role
        if(isset($_SESSION['user_id'])) {
            if($_SESSION['role'] == 'admin') {
                header('Location: ' . BASEURL . '/admin');
            } else {
                header('Location: ' . BASEURL . '/employee');
            }
            exit;
        }

        $data['title'] = 'Login - Sistem Absensi';
        $this->view('layouts/header', $data);
        $this->view('auth/login');
        // Login page biasanya tidak butuh footer kompleks, tapi boleh dipasang
        $this->view('layouts/footer');
    }

    // Proses Logika Login (POST)
    public function process() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Panggil Model User
            $user = $this->model('UserModel')->auth($username);

            // Cek User ada & Password cocok
            if($user && password_verify($password, $user['password'])) {
                // Set Session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['user_data'] = $user; // Simpan semua data user untuk kemudahan

                // Redirect sesuai Role
                if($user['role'] == 'admin') {
                    header('Location: ' . BASEURL . '/admin');
                } else {
                    header('Location: ' . BASEURL . '/employee');
                }
                exit;
            } else {
                // Login Gagal
                echo "<script>alert('Username atau Password Salah!'); window.location.href='".BASEURL."/auth';</script>";
            }
        }
    }

    // Proses Logout
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ' . BASEURL . '/auth');
        exit;
    }
}