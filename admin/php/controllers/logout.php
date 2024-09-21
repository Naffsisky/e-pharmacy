<?php

session_start();

if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header('Location: ../../views/login.php');
    exit();
}

if (isset($_SESSION['start_time']) && isset($_COOKIE['user'])) {
    session_destroy();

    setcookie('user', '', time() - 3600, "/");

    header('Location: ../../views/login.php');
    exit();
}
