<?php

session_start();

if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header('Location: ../views/login.php');
    exit();
}

if (isset($_SESSION['start_time']) && isset($_COOKIE['user'])) {
    // Hitung berapa lama sesi sudah berjalan
    $session_duration = time() - $_SESSION['start_time'];
    if ($session_duration > 21600) { // Jika lebih dari 6 jam (21600 detik)
        session_destroy(); // Hancurkan sesi
        setcookie('user', '', time() - 3600, "/"); // Hapus cookies

        header('Location: ../views/login.php'); // Redirect ke halaman login
        exit();
    }
}
