<?php
require_once('../app/models/orders.php');
$orders = new Orders();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../img/Icon.jpeg" />
    <style>
        .bi {
            vertical-align: -.125em;
            pointer-events: none;
            fill: currentColor;
        }
    </style>
    <title>Orders </title>
</head>

<body>
    <?php if (isset($_SESSION['msg'])) {  ?>
        <?php if ($_SESSION['msg'] !== null) {  ?>
            <div class="alert alert-success alert-dismissible fade show text-center text-uppercase " role="alert" style="position: absolute; width: 100%;" id="alert">
                <strong><?php echo $_SESSION['msg'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php } ?>
    <?php } ?>
    <script>
        $(".alert").alert();
    </script>
    <div class="d-flex bd-highlight">
        <div class="flex-shrink-1 bd-highlight" style="height: 100vh;position: fixed;">
            <?php require_once('aside.php') ?>
        </div>
        <div class="w-100 bd-highlight" style="margin-left: 280px;">
            <div class="title text-center">
                <a href="Orders.php" class="nav-link text-dark text-capitalize fs-3">
                    <svg class="bi me-2" width="25" height="25">
                        <use xlink:href="#table" />
                    </svg>
                    Orders
                </a>
            </div>
            <table class="table mt-5 text-center">
                <thead>
                    <tr>
                        <th>ID Commande</th>
                        <th>Date Commande</th>
                        <th>Etat Commande</th>
                    </tr>
                </thead>
                <?php if ($orders->getallorders() == null) {
                    echo "<h3 class='text-center text-capitalize text-primary'>aucune commande</h3>";
                } else { ?>
                    <tbody>
                        <?php foreach ($orders->getallorders() as $order) {
                            include('./_tableOrder.php');
                        ?>
                            <td class="border-0">
                                <a href="plusorder.php?commande=<?php echo $order->id  ?>">
                                    <img src="../img/plus-square.svg" width="20" height="20" alt="">
                                </a>
                            </td>
                            </tr>
                        <?php   } ?>
                    </tbody>
                <?php } ?>
            </table>

            <?php unset($_SESSION['msg']) ?>
            <script src="../css/bootstrap/bootstrap.bundle.min.js"></script>
            <script src="../js/jquery-3.6.0.min.js"></script>
            <script>
                window.setTimeout(function() {
                    $("#alert").alert('close');
                }, 2000);
                $('.orders').addClass('active');
            </script>
</body>

</html>