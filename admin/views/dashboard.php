<?php

require '../php/config/session_check.php';
require '../php/config/database.php';

$total_stock = show_items("SELECT SUM(stock_product) AS total_stock FROM product;");

$top_buyer = show_items("SELECT * FROM transaction ORDER BY total_price DESC LIMIT 5;");

$restock = show_items("SELECT * FROM product WHERE stock_product ORDER BY stock_product ASC LIMIT 10;");
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
    <title>Dashboard</title>
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
        <p class="title pb-3">Halo, <span style="text-transform: capitalize;"><?php echo $_SESSION['username']; ?></span>! Selamat datang di dashboard.</p>
        <br />
        <div class="infographic">
            <div class="row">
                <div class="col-md-4 pb-5">
                    <div class="card text-white bg-info position-relative">
                        <div class="card-body">
                            <!-- Floating Image -->
                            <div class="d-flex justify-content-center position-absolute w-100" style="top: -30px;">
                                <img src="../assets/img/user.png" alt="Infographic" style="height: 80px; width: auto;">
                            </div>

                            <!-- Content -->
                            <h5 class="card-title mt-5">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pb-5">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-center position-absolute w-100" style="top: -30px;">
                                <img src="../assets/img/stock.png" alt="Infographic" style="height: 80px; width: auto;">
                            </div>
                            <h5 class="card-title mt-5 text-center">Stock Product</h5>
                            <div style="background-color: white; padding: 10px; border-radius: 10px;">
                                <div class="row text-center">
                                    <div class="col-md-1">
                                        <i class="fa-solid fa-cart-shopping" style="color: #198754;"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="card-text" style="color: #198754; font-weight: 600;">Total Stock Product</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="card-text text-center" style="color: #198754; font-weight: 800;"><?php echo $total_stock[0]['total_stock']; ?></p>
                                    </div>
                                </div>
                                <div class="row pt-2 text-center">
                                    <div class="col-md-1">
                                        <i class="fa-solid fa-chart-line" style="color: #198754;"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="card-text" style="color: #198754; font-weight: 600;">Top Selling Product</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="card-text text-center" style="color: #198754; font-weight: 800;">50000</p>
                                    </div>
                                </div>
                                <div class="row pt-2 text-center">
                                    <div class="col-md-1">
                                        <i class="fa-solid fa-calendar" style="color: #198754;"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="card-text" style="color: #198754; font-weight: 600;">Monthly Selling Product</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="card-text text-center" style="color: #198754; font-weight: 800;">50000</p>
                                    </div>
                                </div>
                            </div>
                            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pb-5">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-center position-absolute w-100" style="top: -30px;">
                                <img src="../assets/img/price.png" alt="Infographic" style="height: 80px; width: auto;">
                            </div>
                            <h5 class="card-title mt-5">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-2">
            <h2 class="text-white">Need Restock</h2>
        </div>
        <table class="table">
            <thead>
                <tr class="table-dark">
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Variant</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($restock as $row): ?>
                    <tr class="table">
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $row['name_product']; ?></td>
                        <td><?= $row['stock_product']; ?></td>
                        <td><?= $row['variant_product']; ?></td>
                        <td>
                            <a href="./add_stock.php?id_product=<?= $row['code_product']; ?>" class="btn btn-primary">Restock Now!</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pb-2 pt-2">
            <h2 class="text-white">Top User Spend Product</h2>
        </div>
        <table class="table">
            <thead>
                <tr class="table-dark">
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($top_buyer as $row): ?>
                    <tr class="table">
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $row['user']; ?></td>
                        <td><?= $row['total_price']; ?></td>
                        <td><?= $row['date_transaction']; ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include 'components/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>