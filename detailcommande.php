<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="site web sepacilse de vendu des pieces auto de qualite avec un petit prix">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="icon" type="image/png" href="./img/Icon.jpeg" />
    <style>
        table tr td {
            vertical-align: middle !important;
        }
    </style>
    <title>Detail Commande</title>
</head>

<body>
    <?php
    require_once('entete.php');
    require_once(dirname(__FILE__) . './app/models/Client.php');
    $clients = new Client();
    if (isset($_SESSION['idclient'])) {
        $id = $_SESSION['idclient'];
    } else {
        header("Location:login.php");
        $_SESSION["redirectmeg"] = "Cette Page Nécessite Une Authentification";
        $_SESSION["namepage"] = "yourcommande";
    }
    $idcommande = $_GET['codecommande'] ?? header("Location:YourCommande.php");

    $commmande = $clients->getOnecommmande($idcommande, $id);
    $nbrarticle = 0;
    $total = 0;
    foreach ($commmande as $qte) {
        $nbrarticle += $qte->qte;
        $total += $qte->prix * $qte->qte;
    }
    $nbrarticle > 1 ? $nbrarticle = $nbrarticle . " articles" : $nbrarticle = $nbrarticle . " article";

    ?>
    <div class="container">
        <table class="table my-5 text-center ">
            <thead class="bg-light">
                <tr>
                    <th>ID Commande</th>
                    <th>Date Commande </th>
                    <th>Etat </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php if ($commmande != null) { ?>
                        <td><?php echo $commmande[0]->id ?></td>
                        <td><?php echo $commmande[0]->datecommande ?></td>
                        <td><?php
                            if ($commmande[0]->etat) {
                                echo 'Traiter';
                            } else {
                                echo "En Cours";
                            }

                            ?></td>
                    <?php } ?>
                </tr>
            </tbody>
        </table>
        <h4 class="text-center">
            Produits De Cette Commande
        </h4>
        <table class="table my-5 text-center">
            <thead class="bg-light ">
                <tr>
                    <th>Produit</th>
                    <th>Libelle</th>
                    <th>Qte </th>
                    <th>Prix </th>
                    <th>Sous Total </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commmande as $order) { ?>
                    <tr>
                        <td class="border"><img src="<?php echo './' . $order->path ?>" alt="" style="width: 100px;" class="rounded mx-auto d-block"></td>
                        <td><?php echo $order->libelle ?> </td>
                        <td><?php echo $order->qte ?> </td>
                        <td><?php echo $order->prix ?> </td>
                        <td><?php echo $order->prix * $order->qte ?> </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-3 mx-auto bg-light ">
                <h5 class="text-center text-capitalize">facturation</h5>
                <div class="facturation-panier">
                    <div class="row">
                        <div class="col-md-6 text-start p-3 ">
                            <span class="nbr-article"><?php echo $nbrarticle ?></span>
                        </div>
                        <div class="col-md-6 text-end p-3">
                            <span class="value"><?php echo $total . ' MAD' ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 text-start p-3">
                            <span class="nbr-article">Livraison</span>
                        </div>
                        <div class="col-md-6 text-end p-3">
                            <span class="value"><?php echo $liv = $total > 0 ? 100  : 0  ?> MAD </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 text-start p-3">
                            <span class="nbr-article">Total TTC :</span>
                        </div>
                        <div class="col-md-6 text-end p-3">
                            <span class="value"><?php echo $total += $liv ?> MAD </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="YourCommande.php">
            <img src="./img/arrow-left.svg" alt="" class="rounded mx-auto d-block mt-5" width="30px">
        </a>
    </div>
    <?php require_once("footer.php") ?>
</body>

</html>