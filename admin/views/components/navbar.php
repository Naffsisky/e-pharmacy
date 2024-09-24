<nav class="navbar bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./dashboard.php">
            <img src="../assets/img/logo.png" alt="Logo" width="150" height="70" class="d-inline-block align-text-top" style="margin-left: 10px;">
        </a>

        <div class="d-flex mx-auto">
            <ul class="navbar-nav d-flex flex-row">
                <li class="nav-item mx-3">
                    <!-- Link to dashboard.php -->
                    <a style="font-size: 18px; <?= strpos($_SERVER['PHP_SELF'], 'e-pharmacy/admin/views/dashboard.php') !== false ? 'font-weight: 600; color: #0dcaf0 !important' : '' ?>" class="nav-link text-white" href="./dashboard.php">Home</a>
                </li>
                <li class="nav-item mx-3">
                    <!-- Link to stock.php -->
                    <a style="font-size: 18px; <?= strpos($_SERVER['PHP_SELF'], 'e-pharmacy/admin/views/stock.php') || strpos($_SERVER['PHP_SELF'], 'e-pharmacy/admin/views/add_stock.php') !== false ? 'font-weight: 600; color: #0dcaf0 !important' : '' ?>" class="nav-link text-white" href="./stock.php">Stock</a>
                </li>
                <li class="nav-item mx-3">
                    <a style="font-size: 18px;" class="nav-link text-white <?= strpos($_SERVER['PHP_SELF'], 'user.php') !== false ? 'active' : '' ?>" href="#">User</a>
                </li>
            </ul>
        </div>

        <!-- Logout Button on the right -->
        <div class="d-flex">
            <a href="../php/controllers/logout.php" class="btn btn-danger" style="margin-right: 10px; font-weight: 600;">Logout<i class="fa-solid fa-door-open" style="margin-left: 10px; font-size: 15px;"></i></a>
        </div>
    </div>
</nav>