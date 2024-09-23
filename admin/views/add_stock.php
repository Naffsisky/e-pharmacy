<?php
require '../php/config/session_check.php';
require '../php/config/database.php';

$session_duration = time() - $_SESSION['start_time'];

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
        <div class="pb-3 pt-3">
            <?= $session_duration ?>
            <a href="./stock.php" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>

    </div>
</body>

</html>