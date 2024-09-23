<?php
require './admin/php/config/database.php';

$username = 'nap';
$password = 'admin';

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
$query->bind_param('ss', $username, $hashed_password);

// Eksekusi query
if ($query->execute()) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $query->error;
}

$query->close();
