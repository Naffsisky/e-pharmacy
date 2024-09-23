<?php

session_start();

if (isset($_SESSION['start_time']) && isset($_COOKIE['user'])) {
    // Hitung durasi sesi
    $session_duration = time() - $_SESSION['start_time'];
    if ($session_duration > 5) { // Jika lebih dari 6 jam (21600 detik)
        // Hancurkan session
        session_unset();
        session_destroy();

        // Hapus cookies
        setcookie('user', '', time() - 3600, "/");

        // Redirect ke halaman login
        ob_start();
        header('Location: ../views/login.php');
        ob_end_flush();
        exit();
    }
}


if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header('Location: ../views/login.php');
    exit();
}
