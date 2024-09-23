<?php

session_start();

if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header('Location: ../../views/login.php');
    exit();
} else {
    session_unset();
    session_destroy();

    setcookie('user', '', time() - 3600, "/");

    ob_start();
    header('Location: ../../views/login.php');
    ob_end_flush();
    exit();
}
