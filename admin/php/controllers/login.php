<?php
require '../config/database.php';

session_set_cookie_params(5); // Set session timeout to 6 hours (21600 seconds)
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['username'] = $row['username'];
            $cookie_value = $row['username'];

            // Set cookie (berlaku 6 jam)
            setcookie('user', $cookie_value, time() + 5, "/");

            $_SESSION['start_time'] = time();

            header('Location: ../../views/dashboard.php');
            exit(); // Pastikan keluar setelah redirect
        } else {
            // Jika password salah
            $error = 'Username atau password salah';
            header('Location: ../../views/login.php');
            exit();
        }
    } else {
        // Jika username tidak ditemukan
        $error = 'Username atau password salah';
        header('Location: ../../views/login.php');
        exit();
    }
}
