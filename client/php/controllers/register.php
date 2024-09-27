<?php

require '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $contact = $_POST['contact'];
    $paypalID = $_POST['paypalID'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (empty($username) || empty($name) || empty($password) || empty($email) || empty($dateOfBirth) || empty($gender) || empty($address) || empty($city) || empty($contact) || empty($paypalID)) {
        $_SESSION['error'] = "Semua data harus diisi!";
        header("Location: ../../views/register.php");
        exit();
    }

    $sql = "INSERT INTO user (username, name, password, email, dateOfBirth, gender, address, city, contact, paypalID) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssssssssss", $username, $name, $hashed_password, $email, $dateOfBirth, $gender, $address, $city, $contact, $paypalID);

    // Eksekusi query
    if ($stmt->execute()) {
        $_SESSION['success'] = "Akun berhasil dibuat!";
    } else {
        $_SESSION['error'] = "Gagal membuat akun. Error: " . $stmt->error;
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();

    // Redirect kembali ke halaman form atau daftar akun
    header("Location: ../../views/register.php");
    exit();
} else {
    // Jika bukan metode POST, redirect ke halaman form
    header("Location: ../../views/register.php");
    exit();
}
