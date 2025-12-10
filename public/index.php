<?php
// 1. Mulai Sesi (Cek ID agar tidak double start)
if( !session_id() ) session_start();

// 2. Load File Konfigurasi & Database Wrapper
require_once '../app/config/config.php';
require_once '../app/core/Database.php';

// 3. Load Core MVC (Router & Controller Parent)
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';

// 4. Jalankan Aplikasi (Router)
$app = new App;