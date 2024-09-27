<?php

session_start();

require '../php/config/database.php';

$isLoggedIn = isset($_SESSION['username_client']);

$category = show_items("SELECT DISTINCT variant_product FROM product;");

$category_limit = show_items("SELECT DISTINCT variant_product FROM product ORDER BY variant_product ASC LIMIT 5");

$product = show_items("SELECT * FROM product ORDER BY code_product DESC LIMIT 10;");

$trending = show_items("SELECT * FROM product ORDER BY stock_product LIMIT 10;");

$best_selling = show_items("SELECT * FROM product ORDER BY stock_product ASC LIMIT 10;");

$sirup = show_items("SELECT * FROM product WHERE variant_product = 'Sirup'");

$tablet = show_items("SELECT * FROM product WHERE variant_product = 'Tablet'");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Apotekku - Shoping</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/vendor.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

</head>

<body class="<?php echo $isLoggedIn ? 'logged-in' : ''; ?>">

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <defs>
            <symbol xmlns="http://www.w3.org/2000/svg" id="link" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12 19a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0-4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm-5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm7-12h-1V2a1 1 0 0 0-2 0v1H8V2a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3Zm1 17a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-9h16Zm0-11H4V6a1 1 0 0 1 1-1h1v1a1 1 0 0 0 2 0V5h8v1a1 1 0 0 0 2 0V5h1a1 1 0 0 1 1 1ZM7 15a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0 4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="arrow-right" viewBox="0 0 24 24">
                <path fill="currentColor" d="M17.92 11.62a1 1 0 0 0-.21-.33l-5-5a1 1 0 0 0-1.42 1.42l3.3 3.29H7a1 1 0 0 0 0 2h7.59l-3.3 3.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l5-5a1 1 0 0 0 .21-.33a1 1 0 0 0 0-.76Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="category" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 5.5h-6.28l-.32-1a3 3 0 0 0-2.84-2H5a3 3 0 0 0-3 3v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-10a3 3 0 0 0-3-3Zm1 13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-13a1 1 0 0 1 1-1h4.56a1 1 0 0 1 .95.68l.54 1.64a1 1 0 0 0 .95.68h7a1 1 0 0 1 1 1Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="calendar" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3Zm1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="heart" viewBox="0 0 24 24">
                <path fill="currentColor" d="M20.16 4.61A6.27 6.27 0 0 0 12 4a6.27 6.27 0 0 0-8.16 9.48l7.45 7.45a1 1 0 0 0 1.42 0l7.45-7.45a6.27 6.27 0 0 0 0-8.87Zm-1.41 7.46L12 18.81l-6.75-6.74a4.28 4.28 0 0 1 3-7.3a4.25 4.25 0 0 1 3 1.25a1 1 0 0 0 1.42 0a4.27 4.27 0 0 1 6 6.05Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="plus" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 11h-6V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="minus" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 11H5a1 1 0 0 0 0 2h14a1 1 0 0 0 0-2Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="cart" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.5 19a1.5 1.5 0 1 0 1.5 1.5A1.5 1.5 0 0 0 8.5 19ZM19 16H7a1 1 0 0 1 0-2h8.491a3.013 3.013 0 0 0 2.885-2.176l1.585-5.55A1 1 0 0 0 19 5H6.74a3.007 3.007 0 0 0-2.82-2H3a1 1 0 0 0 0 2h.921a1.005 1.005 0 0 1 .962.725l.155.545v.005l1.641 5.742A3 3 0 0 0 7 18h12a1 1 0 0 0 0-2Zm-1.326-9l-1.22 4.274a1.005 1.005 0 0 1-.963.726H8.754l-.255-.892L7.326 7ZM16.5 19a1.5 1.5 0 1 0 1.5 1.5a1.5 1.5 0 0 0-1.5-1.5Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="check" viewBox="0 0 24 24">
                <path fill="currentColor" d="M18.71 7.21a1 1 0 0 0-1.42 0l-7.45 7.46l-3.13-3.14A1 1 0 1 0 5.29 13l3.84 3.84a1 1 0 0 0 1.42 0l8.16-8.16a1 1 0 0 0 0-1.47Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="trash" viewBox="0 0 24 24">
                <path fill="currentColor" d="M10 18a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1ZM20 6h-4V5a3 3 0 0 0-3-3h-2a3 3 0 0 0-3 3v1H4a1 1 0 0 0 0 2h1v11a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8h1a1 1 0 0 0 0-2ZM10 5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1h-4Zm7 14a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8h10Zm-3-1a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="star-outline" viewBox="0 0 15 15">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M7.5 9.804L5.337 11l.413-2.533L4 6.674l2.418-.37L7.5 4l1.082 2.304l2.418.37l-1.75 1.793L9.663 11L7.5 9.804Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="star-solid" viewBox="0 0 15 15">
                <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="search" viewBox="0 0 24 24">
                <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="close" viewBox="0 0 15 15">
                <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z" />
            </symbol>
        </defs>
    </svg>

    <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div>

    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart" aria-labelledby="My Cart">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span style="color: #30d5c8">Your cart</span>
                    <span class="badge rounded-pill" style="background-color: #30d5c8">0</span>
                </h4>
                <!-- <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Growers cider</h6>
                            <small class="text-body-secondary">Brief description</small>
                        </div>
                        <span class="text-body-secondary">$12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Fresh grapes</h6>
                            <small class="text-body-secondary">Brief description</small>
                        </div>
                        <span class="text-body-secondary">$8</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Heinz tomato ketchup</h6>
                            <small class="text-body-secondary">Brief description</small>
                        </div>
                        <span class="text-body-secondary">$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>$20</strong>
                    </li>
                </ul> -->

                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (Rp)</span>
                        <strong class="total-price">Rp0</strong>
                    </li>
                </ul>

                <p>Total Harga: <span class="total-price">Rp0</span></p>

                <a class="w-100 btn btn-primary btn-lg" type="submit" href="../php/controllers/checkout.php">Continue to checkout</a>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasSearch" aria-labelledby="Search">
        <div class="offcanvas-header justify-content-center">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Search</span>
                </h4>
                <form role="search" action="index.html" method="get" class="d-flex mt-3 gap-0">
                    <input class="form-control rounded-start rounded-0 bg-light" type="email" placeholder="What are you looking for?" aria-label="What are you looking for?">
                    <button class="btn btn-dark rounded-end rounded-0" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>

    <header>
        <div class="container-fluid" style="background-color: #30d5c8;">
            <div class="row py-3 border-bottom">

                <div class="col-sm-4 col-lg-3 text-center text-sm-start">
                    <div class="main-logo">
                        <a href="index.html">
                            <img src="../assets/img/logo.png" style="height: 80px" alt="logo" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
                    <div class="search-bar row bg-light p-2 my-2 rounded-4">
                        <div class="col-md-4 d-none d-md-block">
                            <select class="form-select border-0 bg-transparent">
                                <?php $i = 1; ?>
                                <?php foreach ($category as $row): ?>
                                    <option><?= $row['variant_product'] ?></option>
                                <?php endforeach; ?>
                                <?php $i++; ?>
                            </select>
                        </div>
                        <div class="col-11 col-md-7">
                            <form id="search-form" class="text-center" action="index.html" method="post">
                                <input type="text" class="form-control border-0 bg-transparent" placeholder="Search for more than 20,000 products" />
                            </form>
                        </div>
                        <div class="col-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8 col-lg-4 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
                    <ul class="d-flex justify-content-end list-unstyled m-0">
                        <li>
                            <?php if (isset($_SESSION['username_client'])) :  ?>
                                <a href="../php/controllers/logout.php" class="btn btn-dark" style="text-decoration: none;">
                                    logout
                                </a>
                            <?php else : ?>
                                <a href="./login.php" class="btn btn-dark" style="text-decoration: none;">
                                    login
                                </a>
                            <?php endif; ?>
                        </li>
                        <!-- <li>
                            <a href="#" class="rounded-circle bg-light p-2 mx-1">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <use xlink:href="#heart"></use>
                                </svg>
                            </a>
                        </li> -->
                        <li class="d-lg-none">
                            <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <use xlink:href="#cart"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="d-lg-none">
                            <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <use xlink:href="#search"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>

                    <?php if (isset($_SESSION['username_client'])) : ?>
                        <div class="cart text-end d-none d-lg-block dropdown">
                            <button class="border-0 bg-transparent d-flex flex-column gap-2 lh-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                                <span class="fs-6 text-muted dropdown-toggle">Your Cart</span>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <div class="container-fluid">
            <div class="row py-3">
                <div class="d-flex  justify-content-center justify-content-sm-between align-items-center">
                    <nav class="main-menu d-flex navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                            aria-controls="offcanvasNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

                            <div class="offcanvas-header justify-content-center">
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>

                            <div class="offcanvas-body">
                                <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
                                    <?php $i = 1;
                                    foreach ($category as $row) : ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link"><?= $row['variant_product'] ?></a>
                                        </li>
                                    <?php $i++;
                                    endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <section class="py-3" style="background-color: #30d5c8;background-repeat: no-repeat;background-size: cover;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="banner-blocks">

                        <div class="banner-ad large bg-info block-1">

                            <div class="swiper main-swiper">
                                <div class="swiper-wrapper">

                                    <div class="swiper-slide">
                                        <div class="row banner-content p-5">
                                            <div class="content-wrapper col-md-7">
                                                <div class="categories my-3">Pilihan Terbaik Dokter</div>
                                                <h3 class="display-4">Obat Terpercaya untuk Kesehatan</h3>
                                                <p>Dapatkan solusi kesehatan dari berbagai macam obat yang direkomendasikan para ahli medis untuk membantu pemulihan Anda.</p>
                                                <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">Pesan Sekarang</a>
                                            </div>
                                            <div class="img-wrapper col-md-5">
                                                <img src="images/product-thumb-3.png" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="row banner-content p-5">
                                            <div class="content-wrapper col-md-7">
                                                <div class="categories my-3">Teruji Klinis</div>
                                                <h3 class="display-4">Solusi Untuk Kesehatan Anda</h3>
                                                <p>Dapatkan obat-obatan terbaik untuk menjaga kesehatan Anda, diproduksi dengan standar kualitas tertinggi.</p>
                                                <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">Beli Sekarang</a>
                                            </div>
                                            <div class="img-wrapper col-md-5">
                                                <img src="images/product-thumb-1.png" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="row banner-content p-5">
                                            <div class="content-wrapper col-md-7">
                                                <div class="categories my-3">Aman dan Terpercaya</div>
                                                <h3 class="display-4">Obat Berkualitas untuk Kesehatan</h3>
                                                <p>Temukan berbagai jenis obat dengan kualitas terjamin, siap membantu menjaga kesehatan dan kesejahteraan Anda.</p>
                                                <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">Dapatkan Sekarang</a>
                                            </div>
                                            <div class="img-wrapper col-md-5">
                                                <img src="images/product-thumb-2.png" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-pagination"></div>

                            </div>
                        </div>

                        <div class="banner-ad bg-success-subtle block-2" style="background:url('images/ad-image-1.png') no-repeat;background-position: right bottom">
                            <div class="row banner-content p-5">

                                <div class="content-wrapper col-md-7">
                                    <div class="categories sale mb-3 pb-3">20% off</div>
                                    <h3 class="banner-title">Obat-Obatan Pilihan</h3>
                                    <a href="#" class="d-flex align-items-center nav-link">Shop Collection <svg width="24" height="24">
                                            <use xlink:href="#arrow-right"></use>
                                        </svg></a>
                                </div>

                            </div>
                        </div>

                        <div class="banner-ad bg-danger block-3" style="background:url('images/ad-image-2.png') no-repeat;background-position: right bottom">
                            <div class="row banner-content p-5">

                                <div class="content-wrapper col-md-7">
                                    <div class="categories sale mb-3 pb-3">+15% off</div>
                                    <h3 class="item-title">Pengguna Baru</h3>
                                    <a href="#" class="d-flex align-items-center nav-link">Shop Collection <svg width="24" height="24">
                                            <use xlink:href="#arrow-right"></use>
                                        </svg></a>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- / Banner Blocks -->

                </div>
            </div>
        </div>
    </section>

    <section class="py-5 overflow-hidden" id="category">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                        <h2 class="section-title">Category</h2>

                        <div class="d-flex align-items-center">
                            <a href="#category" class="btn-link text-decoration-none">View All Categories →</a>
                            <div class="swiper-buttons">
                                <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
                                <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="category-carousel swiper">
                        <div class="swiper-wrapper">
                            <?php $i = 1; ?>
                            <?php foreach ($category as $row): ?>
                                <a href="category.html" class="nav-link category-item swiper-slide">
                                    <h3 class="category-title"><?= $row['variant_product'] ?></h3>
                                </a>
                            <?php endforeach; ?>
                            <?php $i++; ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="py-5 overflow-hidden" id="product">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex flex-wrap flex-wrap justify-content-between mb-5">

                        <h2 class="section-title">Newly Arrived Products</h2>

                        <div class="d-flex align-items-center">
                            <a href="#product" class="btn-link text-decoration-none">View All Categories →</a>
                            <div class="swiper-buttons">
                                <button class="swiper-prev brand-carousel-prev btn btn-yellow">❮</button>
                                <button class="swiper-next brand-carousel-next btn btn-yellow">❯</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="brand-carousel swiper">
                        <div class="swiper-wrapper">
                            <?php $i = 1; ?>
                            <?php foreach ($product as $row): ?>
                                <div class="swiper-slide">
                                    <div class="card mb-3 p-3 rounded-4 shadow border-0">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="../../admin/uploads/products/<?= $row['image_product'] ?>" class="img-fluid rounded" alt="Card title">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body py-0">
                                                    <p class="text-muted mb-0"><?= $row['variant_product'] ?></p>
                                                    <h5 class="card-title"><?= $row['name_product'] ?></h5>
                                                    <h3 style="letter-spacing: 2px">Rp<?= $row['price_product'] ?></h3>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php $i++; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <div class="bootstrap-tabs product-tabs">
                        <div class="tabs-header d-flex justify-content-between border-bottom my-5">
                            <h3>Trending Products</h3>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a href="#" class="nav-link text-uppercase fs-6 active" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all">All</a>
                                    <?php $i = 1; ?>
                                    <?php foreach ($category_limit as $row): ?>
                                        <!-- <a href="#" class="nav-link text-uppercase fs-6" id="nav-<?= strtolower($row['variant_product']) ?>-tab" data-bs-toggle="tab" data-bs-target="#nav-<?= strtolower($row['variant_product']) ?>"><?= $row['variant_product'] ?></a> -->
                                    <?php $i++;
                                    endforeach; ?>
                                </div>
                            </nav>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">

                                <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

                                    <?php $i = 1; ?>
                                    <?php foreach ($trending as $row): ?>
                                        <?php $laku = 100 - $row['stock_product'] ?>
                                        <div class="col">
                                            <div class="product-item">
                                                <span class="badge bg-success position-absolute m-3">+<?= $laku ?>%</span>
                                                <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                        <use xlink:href="#heart"></use>
                                                    </svg></a>
                                                <figure>
                                                    <a href="single-product.html" title="Product Title">
                                                        <img src="../../admin/uploads/products/<?= $row['image_product'] ?>" class="tab-image">
                                                    </a>
                                                </figure>
                                                <h3><?= $row['name_product'] ?></h3>
                                                <span class="qty">Stock <?= $row['stock_product'] ?> Unit</span>

                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="input-group product-qty">
                                                        <span class="price">Rp<?= $row['price_product'] ?></span>
                                                    </div>
                                                    <div>
                                                        <!-- <a href="#" class="nav-link" style="color: white;">Add to Cart <iconify-icon icon="uil:shopping-cart"></a> -->
                                                        <button class="add-to-cart-btn btn btn-dark" style="color: white;" data-id="<?= $row['code_product'] ?>" data-name="<?= $row['name_product'] ?>" data-price="<?= $row['price_product'] ?>" data-image="<?= $row['image_product'] ?>">
                                                            Add to Cart
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php $i++; ?>
                                    <?php endforeach; ?>

                                </div>
                                <!-- / product-grid -->

                            </div>

                            <!-- <div class="tab-pane fade" id="nav-fruits" role="tabpanel" aria-labelledby="nav-fruits-tab">

                                <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

                                    <div class="col">
                                        <div class="product-item">
                                            <span class="badge bg-success position-absolute m-3">-30%</span>
                                            <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                    <use xlink:href="#heart"></use>
                                                </svg></a>
                                            <figure>
                                                <a href="single-product.html" title="Product Title">
                                                    <img src="images/thumb-cucumber.png" class="tab-image">
                                                </a>
                                            </figure>
                                            <h3>Sunstar Fresh Melon Juice</h3>
                                            <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                                    <use xlink:href="#star-solid"></use>
                                                </svg> 4.5</span>
                                            <span class="price">$18.00</span>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="input-group product-qty">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                            <svg width="16" height="16">
                                                                <use xlink:href="#minus"></use>
                                                            </svg>
                                                        </button>
                                                    </span>
                                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                            <svg width="16" height="16">
                                                                <use xlink:href="#plus"></use>
                                                            </svg>
                                                        </button>
                                                    </span>
                                                </div>
                                                <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div> -->

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <div class="banner-ad bg-danger mb-3" style="background: url('images/ad-image-3.png');background-repeat: no-repeat;background-position: right bottom;">
                        <div class="banner-content p-5">

                            <div class="categories text-primary fs-3 fw-bold">UP TO 25% OFF</div>
                            <h3 class="banner-title">Obat Sirup</h3>
                            <p>Dapatkan Diskon Hingga 25%</p>
                            <a href="#" class="btn btn-dark text-uppercase">Show Now</a>

                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="banner-ad bg-info" style="background: url('images/ad-image-4.png');background-repeat: no-repeat;background-position: right bottom;">
                        <div class="banner-content p-5">

                            <div class="categories text-primary fs-3 fw-bold">UP TO 25% OFF</div>
                            <h3 class="banner-title">Obat Tablet</h3>
                            <p>Dapatkan Diskon Hingga 25%</p>
                            <a href="#" class="btn btn-dark text-uppercase">Show Now</a>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5 overflow-hidden">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex flex-wrap justify-content-between my-5">

                        <h2 class="section-title">Best selling products</h2>

                        <div class="d-flex align-items-center">
                            <a href="#" class="btn-link text-decoration-none">View All Product →</a>
                            <div class="swiper-buttons">
                                <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                                <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="products-carousel swiper">
                        <div class="swiper-wrapper">

                            <?php $i = 1;
                            foreach ($best_selling as $row): ?>
                                <div class="product-item swiper-slide">
                                    <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                            <use xlink:href="#heart"></use>
                                        </svg></a>
                                    <figure>
                                        <a href="single-product.html" title="Product Title">
                                            <img src="../../admin/uploads/products/<?= $row['image_product'] ?>" class="tab-image">
                                        </a>
                                    </figure>
                                    <h3><?= $row['name_product'] ?></h3>
                                    <span class="qty">Stock <?= $row['stock_product'] ?> Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                            <span class="price">Rp<?= $row['price_product'] ?></span>

                                </div>
                            <?php $i++;
                            endforeach; ?>

                        </div>
                    </div>
                    <!-- / products-carousel -->

                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container-fluid">

            <div class="bg-secondary py-5 my-5 rounded-5" style="background: url('images/bg-leaves-img-pattern.png') no-repeat;">
                <div class="container my-5">
                    <div class="row">
                        <div class="col-md-6 p-5">
                            <div class="section-header">
                                <h2 class="section-title display-4">Get <span class="text-primary">25% Discount</span> on your first purchase</h2>
                            </div>
                        </div>
                        <div class="col-md-6 p-5">
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text"
                                        class="form-control form-control-lg" name="name" id="name" placeholder="Name">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="abc@mail.com">
                                </div>
                                <div class="form-check form-check-inline mb-3">
                                    <label class="form-check-label" for="subscribe">
                                        <input class="form-check-input" type="checkbox" id="subscribe" value="subscribe">
                                        Subscribe to the newsletter</label>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-dark btn-lg">Submit</button>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>

    <section class="py-5 overflow-hidden">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex justify-content-between">

                        <h2 class="section-title">Obat Sirup</h2>

                        <div class="d-flex align-items-center">
                            <a href="#" class="btn-link text-decoration-none">View All Product →</a>
                            <div class="swiper-buttons">
                                <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                                <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="products-carousel swiper">
                        <div class="swiper-wrapper">

                            <?php $i = 1;
                            foreach ($sirup as $row): ?>
                                <div class="product-item swiper-slide">
                                    <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                            <use xlink:href="#heart"></use>
                                        </svg></a>
                                    <figure>
                                        <a href="single-product.html" title="Product Title">
                                            <img src="../../admin/uploads/products/<?= $row['image_product'] ?>" class="tab-image">
                                        </a>
                                    </figure>
                                    <h3><?= $row['name_product'] ?></h3>
                                    <span class="qty">Stock <?= $row['stock_product'] ?> Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                            <span class="price">Rp<?= $row['price_product'] ?></span>
                                            <div class="d-flex align-items-center justify-content-between pt-2">
                                                <!-- <div class="input-group product-qty">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                            <svg width="16" height="16">
                                                                <use xlink:href="#minus"></use>
                                                            </svg>
                                                        </button>
                                                    </span>
                                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                            <svg width="16" height="16">
                                                                <use xlink:href="#plus"></use>
                                                            </svg>
                                                        </button>
                                                    </span>
                                                </div> -->
                                                <div>
                                                    <!-- <a href="#" class="nav-link" style="color: white;">Add to Cart <iconify-icon icon="uil:shopping-cart"></a> -->
                                                    <button class="add-to-cart-btn btn btn-dark" style="color: white;" data-id="<?= $row['code_product'] ?>" data-name="<?= $row['name_product'] ?>" data-price="<?= $row['price_product'] ?>" data-image="<?= $row['image_product'] ?>">
                                                        Add to Cart
                                                    </button>
                                                </div>
                                            </div>
                                </div>
                            <?php $i++;
                            endforeach; ?>

                        </div>
                    </div>
                    <!-- / products-carousel -->

                </div>
            </div>
        </div>
    </section>

    <section class="py-5 overflow-hidden">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex justify-content-between">

                        <h2 class="section-title">Obat Tablet</h2>

                        <div class="d-flex align-items-center">
                            <a href="#" class="btn-link text-decoration-none">View All Product →</a>
                            <div class="swiper-buttons">
                                <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                                <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="products-carousel swiper">
                        <div class="swiper-wrapper">

                            <?php $i = 1;
                            foreach ($tablet as $row): ?>
                                <div class="product-item swiper-slide">
                                    <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                            <use xlink:href="#heart"></use>
                                        </svg></a>
                                    <figure>
                                        <a href="single-product.html" title="Product Title">
                                            <img src="../../admin/uploads/products/<?= $row['image_product'] ?>" class="tab-image">
                                        </a>
                                    </figure>
                                    <h3><?= $row['name_product'] ?></h3>
                                    <span class="qty">Stock <?= $row['stock_product'] ?> Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                            <span class="price">Rp<?= $row['price_product'] ?></span>
                                            <div class="d-flex align-items-center justify-content-between pt-2">
                                                <!-- <div class="input-group product-qty">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                            <svg width="16" height="16">
                                                                <use xlink:href="#minus"></use>
                                                            </svg>
                                                        </button>
                                                    </span>
                                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                            <svg width="16" height="16">
                                                                <use xlink:href="#plus"></use>
                                                            </svg>
                                                        </button>
                                                    </span>
                                                </div> -->
                                                <div>
                                                    <button class="add-to-cart-btn btn btn-dark" style="color: white;" data-id="<?= $row['code_product'] ?>" data-name="<?= $row['name_product'] ?>" data-price="<?= $row['price_product'] ?>" data-image="<?= $row['image_product'] ?>">
                                                        Add to Cart
                                                    </button>
                                                </div>
                                            </div>
                                </div>
                            <?php $i++;
                            endforeach; ?>

                        </div>
                    </div>
                    <!-- / products-carousel -->

                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-5">
                <div class="col">
                    <div class="card mb-3 border-0">
                        <div class="row">
                            <div class="col-md-2 text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M21.5 15a3 3 0 0 0-1.9-2.78l1.87-7a1 1 0 0 0-.18-.87A1 1 0 0 0 20.5 4H6.8l-.33-1.26A1 1 0 0 0 5.5 2h-2v2h1.23l2.48 9.26a1 1 0 0 0 1 .74H18.5a1 1 0 0 1 0 2h-13a1 1 0 0 0 0 2h1.18a3 3 0 1 0 5.64 0h2.36a3 3 0 1 0 5.82 1a2.94 2.94 0 0 0-.4-1.47A3 3 0 0 0 21.5 15Zm-3.91-3H9L7.34 6H19.2ZM9.5 20a1 1 0 1 1 1-1a1 1 0 0 1-1 1Zm8 0a1 1 0 1 1 1-1a1 1 0 0 1-1 1Z" />
                                </svg>
                            </div>
                            <div class="col-md-10">
                                <div class="card-body p-0">
                                    <h5>Free Delivery</h5>
                                    <p class="card-text">Nikmati layanan pengiriman gratis untuk semua pesanan Anda, tanpa batasan!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border-0">
                        <div class="row">
                            <div class="col-md-2 text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19.63 3.65a1 1 0 0 0-.84-.2a8 8 0 0 1-6.22-1.27a1 1 0 0 0-1.14 0a8 8 0 0 1-6.22 1.27a1 1 0 0 0-.84.2a1 1 0 0 0-.37.78v7.45a9 9 0 0 0 3.77 7.33l3.65 2.6a1 1 0 0 0 1.16 0l3.65-2.6A9 9 0 0 0 20 11.88V4.43a1 1 0 0 0-.37-.78ZM18 11.88a7 7 0 0 1-2.93 5.7L12 19.77l-3.07-2.19A7 7 0 0 1 6 11.88v-6.3a10 10 0 0 0 6-1.39a10 10 0 0 0 6 1.39Zm-4.46-2.29l-2.69 2.7l-.89-.9a1 1 0 0 0-1.42 1.42l1.6 1.6a1 1 0 0 0 1.42 0L15 11a1 1 0 0 0-1.42-1.42Z" />
                                </svg>
                            </div>
                            <div class="col-md-10">
                                <div class="card-body p-0">
                                    <h5>100% Secure Payment</h5>
                                    <p class="card-text">Transaksi Anda dijamin aman dengan sistem pembayaran yang terenkripsi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border-0">
                        <div class="row">
                            <div class="col-md-2 text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M22 5H2a1 1 0 0 0-1 1v4a3 3 0 0 0 2 2.82V22a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-9.18A3 3 0 0 0 23 10V6a1 1 0 0 0-1-1Zm-7 2h2v3a1 1 0 0 1-2 0Zm-4 0h2v3a1 1 0 0 1-2 0ZM7 7h2v3a1 1 0 0 1-2 0Zm-3 4a1 1 0 0 1-1-1V7h2v3a1 1 0 0 1-1 1Zm10 10h-4v-2a2 2 0 0 1 4 0Zm5 0h-3v-2a4 4 0 0 0-8 0v2H5v-8.18a3.17 3.17 0 0 0 1-.6a3 3 0 0 0 4 0a3 3 0 0 0 4 0a3 3 0 0 0 4 0a3.17 3.17 0 0 0 1 .6Zm2-11a1 1 0 0 1-2 0V7h2ZM4.3 3H20a1 1 0 0 0 0-2H4.3a1 1 0 0 0 0 2Z" />
                                </svg>
                            </div>
                            <div class="col-md-10">
                                <div class="card-body p-0">
                                    <h5>Quality Guarantee</h5>
                                    <p class="card-text">Kami hanya menyediakan produk dengan standar kualitas terbaik yang dapat diandalkan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border-0">
                        <div class="row">
                            <div class="col-md-2 text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 8.35a3.07 3.07 0 0 0-3.54.53a3 3 0 0 0 0 4.24L11.29 16a1 1 0 0 0 1.42 0l2.83-2.83a3 3 0 0 0 0-4.24A3.07 3.07 0 0 0 12 8.35Zm2.12 3.36L12 13.83l-2.12-2.12a1 1 0 0 1 0-1.42a1 1 0 0 1 1.41 0a1 1 0 0 0 1.42 0a1 1 0 0 1 1.41 0a1 1 0 0 1 0 1.42ZM12 2A10 10 0 0 0 2 12a9.89 9.89 0 0 0 2.26 6.33l-2 2a1 1 0 0 0-.21 1.09A1 1 0 0 0 3 22h9a10 10 0 0 0 0-20Zm0 18H5.41l.93-.93a1 1 0 0 0 0-1.41A8 8 0 1 1 12 20Z" />
                                </svg>
                            </div>
                            <div class="col-md-10">
                                <div class="card-body p-0">
                                    <h5>Guaranteed Savings</h5>
                                    <p class="card-text">Temukan harga terbaik di setiap produk dengan diskon dan penawaran khusus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border-0">
                        <div class="row">
                            <div class="col-md-2 text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M18 7h-.35A3.45 3.45 0 0 0 18 5.5a3.49 3.49 0 0 0-6-2.44A3.49 3.49 0 0 0 6 5.5A3.45 3.45 0 0 0 6.35 7H6a3 3 0 0 0-3 3v2a1 1 0 0 0 1 1h1v6a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3v-6h1a1 1 0 0 0 1-1v-2a3 3 0 0 0-3-3Zm-7 13H8a1 1 0 0 1-1-1v-6h4Zm0-9H5v-1a1 1 0 0 1 1-1h5Zm0-4H9.5A1.5 1.5 0 1 1 11 5.5Zm2-1.5A1.5 1.5 0 1 1 14.5 7H13ZM17 19a1 1 0 0 1-1 1h-3v-7h4Zm2-8h-6V9h5a1 1 0 0 1 1 1Z" />
                                </svg>
                            </div>
                            <div class="col-md-10">
                                <div class="card-body p-0">
                                    <h5>Daily Offers</h5>
                                    <p class="card-text">Dapatkan penawaran menarik setiap hari dengan produk pilihan dan harga spesial.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="footer-bottom" style="background-color: #30d5c8;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 copyright text-center pt-3">
                    <p class="text-light">© 2024 Copyright</p>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="../js/plugins.js"></script>
    <script src="../js/script.js"></script>
    <script>
        // Fungsi untuk memeriksa status login
        function checkLoginStatus() {
            return document.body.classList.contains('logged-in');
        }

        // Array untuk menyimpan item di cart
        let cartItems = [];

        // Fungsi untuk menambahkan item ke dalam cart
        function addToCart(item) {
            if (!checkLoginStatus()) {
                alert("Silakan login terlebih dahulu untuk menambahkan item ke keranjang.");
                return;
            }

            // Kode yang ada untuk menambahkan item ke keranjang
            const existingItem = cartItems.find(cartItem => cartItem.id === item.id);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cartItems.push({
                    ...item,
                    quantity: 1
                });
            }

            updateCartDisplay();
            alert("Produk " + item.name + " ditambahkan ke keranjang.");
        }

        // Fungsi untuk memperbarui tampilan cart
        function updateCartDisplay() {
            if (!checkLoginStatus()) return;

            // Kode yang ada untuk memperbarui tampilan keranjang
            const cartElement = document.querySelector('#offcanvasCart .list-group');
            const totalElements = document.querySelectorAll('.total-price');
            const badgeElement = document.querySelector('#offcanvasCart .badge');

            cartElement.innerHTML = '';

            let total = 0;
            let totalQuantity = 0;

            cartItems.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                totalQuantity += item.quantity;

                cartElement.innerHTML += `
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                    <h6 class="my-0">${item.name}</h6>
                    <small class="text-body-secondary">${item.quantity} x Rp${item.price.toFixed(2)}</small>
                </div>
                <span class="text-body-secondary">Rp${itemTotal.toFixed(2)}</span>
            </li>
        `;
            });

            totalElements.forEach(element => {
                element.textContent = `Rp${total.toFixed(2)}`;
            });

            if (badgeElement) {
                badgeElement.textContent = totalQuantity;
            }
        }

        // Event listener untuk tombol "Add to Cart"
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function() {
                if (!checkLoginStatus()) {
                    alert("Silakan login terlebih dahulu untuk menambahkan item ke keranjang.");
                    return;
                }

                const item = {
                    id: this.getAttribute('data-id'),
                    name: this.getAttribute('data-name'),
                    price: parseFloat(this.getAttribute('data-price')),
                    image: this.getAttribute('data-image')
                };
                addToCart(item);
            });
        });

        // Inisialisasi tampilan keranjang saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            if (checkLoginStatus()) {
                updateCartDisplay();
            }
        });
    </script>
</body>

</html>