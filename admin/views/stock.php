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

$sql = "SELECT * FROM product ORDER BY code_product ASC";
$result = show_items($sql);

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
    <title>Stock</title>
</head>

<body>
    <style>
        th {
            text-align: center;
            vertical-align: middle;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

        .product-cell {
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image {
            max-width: 150px;
            max-height: 100px;
            object-fit: contain;
        }
    </style>
    <?php include 'components/navbar.php'; ?>

    <div class="container">
        <div class="pb-3 pt-3" style="text-align: right">
            <a href="./add_stock.php" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Stock</a>
        </div>
        <?= isset($error) ? '<div id="alertBox" class="alert alert-danger" role="alert">' . $error . '</div>' : '' ?>
        <?= isset($success) ? '<div id="alertBox" class="alert alert-success" role="alert">' . $success . '</div>' : '' ?>
        <table class="table">
            <thead>
                <tr class="table">
                    <th scope="col">No.</th>
                    <th scope="col">Code</th>
                    <th scope="col">Name Product</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Variant</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($result as $row) : ?>
                    <tr class="table-dark">
                        <th scope="row" class="align-middle"><?= $i; ?></th>
                        <td class="align-middle"><?= $row['code_product']; ?></td>
                        <td class="align-middle"><?= $row['name_product']; ?></td>
                        <td class="align-middle"><?= $row['stock_product']; ?></td>
                        <td class="align-middle"><?= $row['variant_product']; ?></td>
                        <td class="align-middle">
                            <div class="product-cell">
                                <?php if (!empty($row['image_product'])) : ?>
                                    <img src="../uploads/products/<?= $row['image_product']; ?>" class="product-image" alt="Product Image">
                                <?php else : ?>
                                    <p>No Image Available</p>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="align-middle">Rp<?= $row['price_product']; ?></td>
                        <td class="align-middle">
                            <a href="./edit_stock.php?id=<?= $row['code_product']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td class="align-middle">
                            <a href="../php/controllers/delete_stock.php?id=<?= $row['code_product']; ?>"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
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
    </script>
</body>

</html>