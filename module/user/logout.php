<?php
session_destroy(); // Hapus semua sesi
header('Location: ' . BASE_URL . '/user/login');
exit;
?>