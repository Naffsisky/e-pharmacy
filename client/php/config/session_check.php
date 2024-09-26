<?php

session_start();

// Jika belum login, redirect ke halaman login
if (!isset($_SESSION['username_client'])) {
    header('Location: ../views/login.php');
    exit();
}

if (isset($_SESSION['start_time_client']) && isset($_SESSION['username_client'])) {
    // Hitung durasi sesi
    $session_duration = time() - $_SESSION['start_time_client'];
    if ($session_duration > 21600) { // Jika lebih dari 6 jam (21600 detik)
        session_unset();
        session_destroy();

        ob_start();
        header('Location: ../views/login.php');
        ob_end_flush();
        exit();
    }
}

if (!isset($_SESSION['start_time_client']) || !isset($_SESSION['username_client'])) {
    session_unset();
    session_destroy();

    // Redirect ke halaman login
    ob_start();
    header('Location: ../views/login.php');
    ob_end_flush();
    exit();
}
