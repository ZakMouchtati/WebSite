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
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" type="image/png" href="./img/Icon.jpeg" />
    <title>Commande</title>
</head>

<body>
    <?php
    require_once('entete.php');
    require_once(dirname(__FILE__) . './app/models/Panier.php');
    require_once(dirname(__FILE__) . './app/models/validercommande.php');
    $commande = new Commande();
    $id_client;
    $methodpaiment;
    $panier = new Panier();
    $list = $panier->GetAllItem();
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $id_client = $_POST['id_client'] ?? "";
        $methodpaiment = $_POST['paiment'] ?? "";
        $commande->AddCommmande($id_client, $methodpaiment, $list);
        unset($_SESSION['panier']);
    }

    ?>
    <div class="container">
        <div class="alert alert-success my-5" role="alert">
            <h4 class="alert-heading">Bien fait!</h4>
            <p>Votre Commande a ete traité avec succes </p>
            <hr>
            <p class="mb-0"> Merci de avoir commnade de CARL.</p>
        </div>

    </div>
    <?php require_once('footer.php') ?>
</body>

</html>