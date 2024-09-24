<?php
require '../php/config/session_check.php';
require '../php/config/database.php';

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Hapus pesan setelah ditampilkan
}

if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']); // Hapus pesan setelah ditampilkan
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />

    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Add Stock</title>
</head>

<body>
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }

        .form-control {
            padding: 10px;
        }

        label {
            color: white;
        }
    </style>
    <?php include 'components/navbar.php'; ?>

    <div class="container">
        <div class="row py-4">
            <div class="col-4">
                <a href="./stock.php" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </div>
            <div class="col-4" style="text-align: center">
                <h3 class="text-white">Add Stock</h3>
            </div>
            <div class="col-4" style="text-align: right">

            </div>
        </div>
        <div class="row justify-content-center">
            <?php if (isset($error)) : ?>
                <div id="alertBox" class="alert alert-danger text-center"><?php echo $error; ?></div>
            <?php endif; ?>
            <div class="col-md-4">
                <form class="row g-3" action="../php/controllers/add_stock.php" method="POST" enctype="multipart/form-data">
                    <div class="col-6 mb-3">
                        <label for="code_product" class="form-label">Code Product</label>
                        <input type="text" class="form-control" id="code_product" name="code_product">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="variant_product" class="form-label">Variant Product</label>
                        <input type="text" class="form-control" id="variant_product" name="variant_product">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="name_product" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name_product" name="name_product">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="price_product" class="form-label">Price</label>
                        <input type="text" maxlength="15" class="form-control" id="price_product" name="price_product" oninput="formatRupiah(this)">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="stock_product" class="form-label">Stock <small class="text-warning">(Max 99999)</small></label>
                        <input type="text" maxlength="6" class="form-control" id="stock_product" name="stock_product" oninput="formatStock(this)">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="desc_product" class="form-label">Product Description</label>
                        <textarea type="text" class="form-control" id="desc_product" name="desc_product"> </textarea>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="image_product" class="form-label">Product Image</label>
                        <input type="file" accept="image/png, image/jpg, image/jpeg" class="form-control" id="image_product" name="image_product">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary px-5">Add Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include 'components/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            if ($('#alertBox').length > 0) {
                setTimeout(function() {
                    $('#alertBox').fadeOut('slow');
                }, 3000);
            }
        });

        function formatRupiah(input) {
            // Hapus karakter non-digit
            let value = input.value.replace(/\D/g, '');

            // Format angka dengan titik setiap 3 digit
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            // Update nilai input
            input.value = value;
        }

        function formatStock(input) {
            // Hapus karakter non-digit
            let value = input.value.replace(/\D/g, '');

            // Format angka dengan titik setiap 3 digit
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            // Update nilai input
            input.value = value;
        }
    </script>
</body>

</html>