<?php

require '../config/database.php';

session_start();

if (isset($_GET['id'])) {
    $id_product = $_GET['id'];

    // Cek apakah id_product ada
    if (empty($id_product)) {
        $_SESSION['error'] = "ID produk tidak ditemukan!";
        header("Location: ../../views/stock.php"); // Redirect ke halaman daftar produk
        exit();
    }

    global $conn;

    // Hapus gambar terlebih dahulu jika ada
    $query = "SELECT image_product FROM product WHERE code_product = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id_product);
    $stmt->execute();
    $stmt->bind_result($image_product);
    $stmt->fetch();
    $stmt->close();

    if ($image_product) {
        $upload_dir = "../../uploads/products/";
        $image_path = $upload_dir . $image_product;

        // Jika file gambar ada, hapus file
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    // Query untuk menghapus produk berdasarkan code_product
    $sql = "DELETE FROM product WHERE code_product = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id_product);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Produk berhasil dihapus!";
    } else {
        $_SESSION['error'] = "Gagal menghapus produk. Error: " . $stmt->error;
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();

    // Redirect ke halaman daftar produk setelah penghapusan
    header("Location: ../../views/stock.php");
    exit();
} else {
    // Jika tidak ada parameter id, redirect ke halaman daftar produk
    header("Location: ../../views/stock.php");
    exit();
}
