<?php
require(dirname(__FILE__) . './app/models/product.php');
$items = new Product();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="site web sepacilse de vendu des pieces auto de qualite avec un petit prix">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="icon" type="image/png" href="./img/Icon.jpeg" />
    <title>Accueil</title>
    <style>

    </style>
</head>

<body>
    <?php require_once('entete.php') ?>
    <div class="items my-3">
        <div class="container">
            <?php
            foreach ($items->index() as $item) {
                include('./_Oneproduit.php');
            } ?>
            <div class="clearfix"></div>
        </div>
    </div>

    <?php require("footer.php") ?>
</body>

</html>