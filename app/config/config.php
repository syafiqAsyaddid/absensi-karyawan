<?php
// Base URL configuration
$baseUrl = getenv('BASEURL') ?: 'http://localhost/aabw-absensi/public';
define('BASEURL', $baseUrl);

// Database configuration
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'aabw_absensi');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}