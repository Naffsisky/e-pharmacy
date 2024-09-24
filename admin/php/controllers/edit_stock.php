<?php

require '../config/database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dapatkan data dari form
    $code_product = $_POST['code_product'];
    $variant_product = $_POST['variant_product'];
    $name_product = $_POST['name_product'];
    $price_product = str_replace('.', '', $_POST['price_product']); // Menghapus titik dari format harga
    $stock_product = $_POST['stock_product'];
    $desc_product = $_POST['desc_product'];

    // Validasi data wajib
    if (empty($code_product) || empty($name_product) || empty($price_product) || empty($stock_product)) {
        $_SESSION['error'] = "Semua data harus diisi!";
        header("Location: ../../views/edit_stock.php?id=$code_product");
        exit();
    }

    global $conn;

    // Query untuk mendapatkan data lama dari produk (terutama gambar)
    $query = "SELECT image_product FROM product WHERE code_product = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $code_product);
    $stmt->execute();
    $stmt->bind_result($old_image_product);
    $stmt->fetch();
    $stmt->close();

    $new_image_product = $old_image_product;

    // Periksa apakah gambar baru di-upload
    if (isset($_FILES['image_product']) && $_FILES['image_product']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png'];
        $filename = $_FILES['image_product']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        // Validasi tipe file gambar
        if (!in_array(strtolower($filetype), $allowed)) {
            $_SESSION['error'] = "Hanya file JPG, JPEG, dan PNG yang diizinkan.";
            header("Location: ../../views/edit_stock.php?id=$code_product");
            exit();
        }

        // Buat nama file unik dan tentukan direktori penyimpanan
        $new_image_product = uniqid() . "." . $filetype;
        $upload_dir = "../../uploads/products/";

        // Hapus gambar lama jika ada
        if (!empty($old_image_product) && file_exists($upload_dir . $old_image_product)) {
            unlink($upload_dir . $old_image_product);
        }

        // Pindahkan file gambar baru ke folder yang ditentukan
        if (!move_uploaded_file($_FILES['image_product']['tmp_name'], $upload_dir . $new_image_product)) {
            $_SESSION['error'] = "Gagal mengupload gambar baru.";
            header("Location: ../../views/edit_stock.php?id=$code_product");
            exit();
        }
    }

    // Query untuk update produk
    $sql = "UPDATE product SET name_product = ?, variant_product = ?, stock_product = ?, desc_product = ?, price_product = ?, image_product = ? WHERE code_product = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $name_product, $variant_product, $stock_product, $desc_product, $price_product, $new_image_product, $code_product);

    // Eksekusi query dan cek hasil
    if ($stmt->execute()) {
        $_SESSION['success'] = "Produk berhasil diperbarui!";
    } else {
        $_SESSION['error'] = "Gagal memperbarui produk. Silakan coba lagi.";
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();

    // Redirect kembali ke halaman form edit atau daftar produk
    header("Location: ../../views/edit_stock.php?id=$code_product");
    exit();
} else {
    // Jika bukan metode POST, redirect ke halaman form
    header("Location: ../../views/product_list.php");
    exit();
}
