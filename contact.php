<?php
require_once("./app/models/boite.php");
$status = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $object = $_POST["object"];
    $message = $_POST["message"];
    $boite = new Boite();
    $boite->AddMessage($email, $object, $message);
    $status = true;
}
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
    <link rel="stylesheet" href="./css/Contact.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="icon" type="image/png" href="../img/Icon.jpeg" />
    <title>Contact</title>
</head>

<body>
    <?php require_once('entete.php') ?>
    <div class="contact">
        <div class="container">
            <form action="" method="POST">
                <?php if ($status) { ?>
                    <div class="alert alert-success" id="alert" role="alert" style="width: 90%; margin: 10px auto !important;">
                        <strong>Message Envoyer Avec Succes</strong>
                    </div>
                <?php } ?>
                <h2>Contactez nous</h2>
                <input type="email" placeholder="Email" required name="email" />
                <input type="text" placeholder="Object" required name="object" />
                <textarea name="message" id="" cols="30" rows="10" placeholder="Message" required></textarea>
                <input type="submit" />
            </form>
            <div class="adresse text-center">
                <h3 class="text-center">CARl.MA</h3>
                <p>7, rue Zakaria boulevard Qods</p>
                <p>Abdlmonen – Casablanca</p>
                <p>
                    <a href="mailto:zakaria.mouchtati@gmail.com">Adresse Mail </a>
                    +212 621 586 010 / +212 521 586 010
                </p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php require("./footer.php") ?>
</body>

</html>