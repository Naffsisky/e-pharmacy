<?php
require '../config/database.php';

session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {

            // Set session variables
            $_SESSION['username_client'] = $row['username'];
            $_SESSION['start_time_client'] = time();

            header('Location: ../../views/homepage.php');
            exit(); // Pastikan keluar setelah redirect
        } else {
            // Jika password salah
            $_SESSION['error'] = 'Username atau password salah';
            header('Location: ../../views/login.php');
            exit();
        }
    } else {
        // Jika username tidak ditemukan
        $_SESSION['error'] = 'Username atau password salah';
        header('Location: ../../views/login.php');
        exit();
    }
}
