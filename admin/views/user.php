<?php
require '../php/config/session_check.php';
require '../php/config/database.php';

if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header('Location: ./login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>tes</p>
</body>

</html>