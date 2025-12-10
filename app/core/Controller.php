<?php
class Controller {
    // Method untuk memanggil View (Tampilan)
    public function view($view, $data = []) {
        // Cek apakah file view ada
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            // Die/Stop jika file view tidak ditemukan (untuk debugging)
            die("View '$view' tidak ditemukan!");
        }
    }

    // Method untuk memanggil Model (Database Logic)
    public function model($model) {
        // Cek apakah file model ada
        if (file_exists('../app/models/' . $model . '.php')) {
            require_once '../app/models/' . $model . '.php';
            // Instansiasi model (misal: return new UserModel())
            return new $model;
        } else {
            die("Model '$model' tidak ditemukan!");
        }
    }
}