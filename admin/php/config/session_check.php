<?php

session_start();

// Jika belum login, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header('Location: ../views/login.php');
    exit();
}

if (isset($_SESSION['start_time']) && isset($_SESSION['username'])) {
    // Hitung durasi sesi
    $session_duration = time() - $_SESSION['start_time'];
    if ($session_duration > 21600) { // Jika lebih dari 6 jam (21600 detik)
        session_unset();
        session_destroy();

        ob_start();
        header('Location: ../views/login.php');
        ob_end_flush();
        exit();
    }
}

if (!isset($_SESSION['start_time']) || !isset($_SESSION['username'])) {
    session_unset();
    session_destroy();

    // Redirect ke halaman login
    ob_start();
    header('Location: ../views/login.php');
    ob_end_flush();
    exit();
}
