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
    <title>Your Commandes</title>
</head>

<body>
    <?php
    require_once("entete.php");
    require_once(dirname(__FILE__) . './app/models/Client.php');
    $clients = new Client();
    if (isset($_SESSION['idclient'])) {
        $id = $_SESSION['idclient'];
    } else {
        header("Location:login.php");
        $_SESSION["redirectmeg"] = "Cette Page Nécessite Une Authentification";
        $_SESSION["namepage"] = "yourcommande";
    }
    $commandes = $clients->getconnamdes($id);
    ?>
    <div class="container">
        <table class="table my-5">
            <thead class="bg-light">
                <tr>
                    <th>ID Commande</th>
                    <th>Date Commande </th>
                    <th>Etat </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande) { ?>
                    <tr>
                        <td><?php echo $commande->id ?></td>
                        <td><?php echo $commande->datecommande ?></td>
                        <td>
                            <?php
                            if ($commande->etat) {
                                echo 'Traiter';
                            } else {
                                echo "En Cours";
                            }
                            ?>
                        </td>
                        <td class="border-0 "><a href="detailcommande.php?<?php echo "codecommande=$commande->id" ?>" class="btn btn-primary text-center mx-auto">Voir Details</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if ($commandes == null) { ?>
            <h5 class="text-center my-3 text-uppercase">Vous n'avez aucune commande</h5>
            <a href="./index.php">
                <img src="./img/arrow-left.svg" alt="More" title="More Shopping" class="rounded mx-auto d-block mt-5" width="30px">
            </a>
        <?php } ?>
    </div>
    <?php require_once("footer.php") ?>
</body>

</html>