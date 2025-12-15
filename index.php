<?php
// 1. Mulai Session paling awal
session_start();

include "config.php";
include "class/Database.php";
include "class/Form.php";

// ROUTING LOGIC
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/home/index';
$segments = explode('/', trim($path, '/'));
$mod = isset($segments[0]) ? $segments[0] : 'home';
$page = isset($segments[1]) ? $segments[1] : 'index';

// 2. Cek Session Login
// Daftar halaman yang boleh diakses tanpa login (Public)
$public_pages = ['home', 'user']; 

// Jika modul yang diakses BUKAN public, cek login
if (!in_array($mod, $public_pages)) {
    // Jika tidak ada session 'is_login', paksa ke halaman login
    if (!isset($_SESSION['is_login'])) {
        header('Location: ' . BASE_URL . '/user/login');
        exit();
    }
}

// Menentukan file view
$file = "module/{$mod}/{$page}.php";

if (file_exists($file)) {
    // 3. Tampilan Khusus Login
    // Jika sedang di halaman login, jangan tampilkan Header & Footer
    if ($mod == 'user' && $page == 'login') {
        include $file;
    } else {
        include "template/header.php";
        include $file;
        include "template/footer.php";
    }
} else {
    echo "Halaman tidak ditemukan.";
}
?>