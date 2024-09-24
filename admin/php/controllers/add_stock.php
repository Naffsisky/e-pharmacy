<?php

require '../config/database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code_product = $_POST['code_product'];
    $variant_product = $_POST['variant_product'];
    $name_product = $_POST['name_product'];
    $price_product = str_replace('.', '', $_POST['price_product']); // Hapus titik dari format harga
    $stock_product = $_POST['stock_product'];
    $desc_product = $_POST['desc_product'];

    if (empty($code_product) || empty($name_product) || empty($price_product) || empty($stock_product)) {
        $_SESSION['error'] = "Semua data harus diisi!";
        header("Location: ../../views/add_stock.php");
        exit();
    }

    $image_product = '';
    if (isset($_FILES['image_product']) && $_FILES['image_product']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png'];
        $filename = $_FILES['image_product']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        if (!in_array(strtolower($filetype), $allowed)) {
            $_SESSION['error'] = "Hanya file JPG, JPEG, dan PNG yang diizinkan.";
            header("Location: ../../views/add_stock.php");
            exit();
        }

        $image_product = uniqid() . "." . $filetype;
        $upload_dir = "../../uploads/products/";

        if (!move_uploaded_file($_FILES['image_product']['tmp_name'], $upload_dir . $image_product)) {
            $_SESSION['error'] = "Gagal mengupload gambar.";
            header("Location: ../../views/add_stock.php");
            exit();
        }
    }

    global $conn;

    $code_product = $code_product . '-' . $variant_product . 'v' . uniqid();

    $sql = "INSERT INTO product (code_product, name_product, stock_product, desc_product, image_product, variant_product, price_product) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // Bind parameter (ssissss = string, string, integer, string, string, string, string)
    $stmt->bind_param("ssissss", $code_product, $name_product, $stock_product, $desc_product, $image_product, $variant_product, $price_product);

    // Eksekusi query
    if ($stmt->execute()) {
        $_SESSION['success'] = "Produk berhasil ditambahkan!";
    } else {
        $_SESSION['error'] = "Gagal menambahkan produk. Error: " . $stmt->error;
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();

    // Redirect kembali ke halaman form atau daftar produk
    header("Location: ../../views/add_stock.php");
    exit();
} else {
    // Jika bukan metode POST, redirect ke halaman form
    header("Location: ../../views/add_stock.php");
    exit();
}
