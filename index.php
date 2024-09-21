<?php

// Tangkap URL request
$request = $_SERVER['REQUEST_URI'];

// Hapus query string (jika ada) dari URL
$request = strtok($request, '?');

// Definisikan routing
switch ($request) {
    case '/':
        require 'client/views/login.html';  // Default halaman (misalnya login client)
        break;

    case '/admin':
        require 'admin/views/login.php';    // Halaman login admin
        break;

    case '/admin/dashboard':
        require 'admin/views/dashboard.php'; // Halaman dashboard admin
        break;

    default:
        http_response_code(404);
        echo '404 - Page Not Found';
        break;
}
