<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // 1. Login Logic
    public function auth($username) {
        $this->db->query("SELECT * FROM users WHERE username = :u");
        $this->db->bind('u', $username);
        return $this->db->single();
    }

    // 2. Ambil Semua Data Karyawan
    public function getAllEmployees() {
        $this->db->query("SELECT * FROM users WHERE role = 'karyawan' ORDER BY id DESC");
        return $this->db->resultSet();
    }

    // 3. Pencarian Karyawan (Search)
    public function searchEmployees($keyword) {
        $keyword = "%$keyword%";
        $this->db->query("SELECT * FROM users WHERE role = 'karyawan' AND (nama LIKE :key OR username LIKE :key) ORDER BY id DESC");
        $this->db->bind('key', $keyword);
        return $this->db->resultSet();
    }

    // 4. Tambah User Baru
    public function addUser($data) {
        $query = "INSERT INTO users (nama, username, password, alamat, jabatan, gaji_pokok, jenis_kelamin, role) 
                  VALUES (:nm, :us, :pw, :al, :jb, :gj, :jk, 'karyawan')";
        
        $this->db->query($query);
        $this->db->bind('nm', $data['nama']);
        $this->db->bind('us', $data['username']);
        $this->db->bind('pw', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind('al', $data['alamat']);
        $this->db->bind('jb', $data['jabatan']);
        $this->db->bind('gj', $data['gaji']);
        $this->db->bind('jk', $data['jk']);
        
        return $this->db->execute();
    }

    // 5. Ambil User Berdasarkan ID (Untuk Edit)
    public function getUserById($id) {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // 6. Update User (Edit)
    public function updateUser($data) {
        // Cek apakah password diisi atau kosong
        if(!empty($data['password'])) {
            // Jika password diisi, update password juga
            $query = "UPDATE users SET nama=:nm, username=:us, password=:pw, alamat=:al, jabatan=:jb, gaji_pokok=:gj, jenis_kelamin=:jk WHERE id=:id";
        } else {
            // Jika kosong, jangan ubah password lama
            $query = "UPDATE users SET nama=:nm, username=:us, alamat=:al, jabatan=:jb, gaji_pokok=:gj, jenis_kelamin=:jk WHERE id=:id";
        }

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nm', $data['nama']);
        $this->db->bind('us', $data['username']);
        $this->db->bind('al', $data['alamat']);
        $this->db->bind('jb', $data['jabatan']);
        $this->db->bind('gj', $data['gaji']);
        $this->db->bind('jk', $data['jk']);

        if(!empty($data['password'])) {
            $this->db->bind('pw', password_hash($data['password'], PASSWORD_DEFAULT));
        }

        return $this->db->execute();
    }

    // 7. Hapus User
    public function deleteUser($id) {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}