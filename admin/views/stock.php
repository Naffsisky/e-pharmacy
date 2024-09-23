<?php
require '../php/config/session_check.php';
require '../php/config/database.php';

$sql = "SELECT * FROM product";
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
        }

        td {
            text-align: center;
        }
    </style>
    <?php include 'components/navbar.php'; ?>

    <div class="container">
        <div class="pb-3 pt-3" style="text-align: right">
            <a href="./add_stock.php" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Stock</a>
        </div>
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
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $row['code_product']; ?></td>
                        <td><?= $row['name_product']; ?></td>
                        <td><?= $row['stock_product']; ?></td>
                        <td><?= $row['variant_product']; ?></td>
                        <td>
                            <?php if (!empty($row['image_product'])) : ?>
                                <img src="../assets/img/<?= $row['image_product']; ?>" style="width: 100px; height: 100px;" alt="">
                            <?php else : ?>
                                <p>No Image Available</p>
                            <?php endif; ?>
                        </td>
                        <td><?= $row['price_product']; ?></td>
                        <td><a href="edit.php?id=<?= $row['code_product']; ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="delete.php?id=<?= $row['code_product']; ?>"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>