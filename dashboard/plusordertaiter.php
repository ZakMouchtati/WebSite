<?php
require_once("../app/models/orders.php");
session_start();
$orders = new Orders();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $_SESSION['msg'] = $orders->traitercommande($_POST['idcommande']);
    header("location:Orders.php");
}
$order = $orders->getoneorder($_GET['commande']);
$nbrarticle = 0;
$total = 0;
foreach ($order as $qte) {
    $nbrarticle += $qte->qte;
    $total += $qte->prix * $qte->qte;
}
$nbrarticle > 1 ? $nbrarticle = $nbrarticle . " articles" : $nbrarticle = $nbrarticle . " article";

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
    <title>Details Commande</title>
</head>

<body>

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
            <div class="d-flex">
                <div class="col-md-6 text-center">
                    <h5>Nom Complet :</h5>
                    <p class="text-warning text-capitalize"><?php echo "{$order[0]->nom} {$order[0]->prenom} " ?></p>
                </div>
                <div class="col-md-6 text-center">
                    <h5>Email Complet :</h5>
                    <p class="text-warning text-capitalize"><?php echo $order[0]->email ?></p>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-md-6 text-center">
                    <h5>TEl Complet :</h5>
                    <p class="text-warning text-capitalize"><?php echo $order[0]->tel ?></p>
                </div>
                <div class="col-md-6 text-center">
                    <h5>Adresse Complet :</h5>
                    <p class="text-warning text-capitalize"><?php echo $order[0]->adresse ?></p>
                </div>
            </div>
            <table class="table mt-5 text-center">
                <thead>
                    <tr>
                        <th>ID Commande</th>
                        <th>Date Commande</th>
                        <th>Etat Commande</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($order !== null) { ?>
                        <tr>
                            <td><?php echo $order[0]->id ?></td>
                            <td><?php echo $order[0]->datecommande ?></td>
                            <td><?php echo $order[0]->etat ?></td>
                        </tr>
                    <?php } ?>
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
                    <?php foreach ($order as $Oneorder) { ?>
                        <tr>
                            <td class="border"><img src="<?php echo "../" . $Oneorder->path ?>" alt="" style="width: 100px;" class="rounded mx-auto d-block"></td>
                            <td><?php echo $Oneorder->libelle ?> </td>
                            <td><?php echo $Oneorder->qte ?> </td>
                            <td><?php echo $Oneorder->prix ?> </td>
                            <td><?php echo $Oneorder->prix * $Oneorder->qte ?> </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
            <div class="col-md-12 p-3">
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
            <div class="mt-5 text-center">
                <a href="Historiquecommnade.php">
                    <img src="../img/arrow-left.svg" alt="" class="rounded" width="30px">
                </a>
            </div>
        </div>
    </div>
</body>
<script src="../css/bootstrap/bootstrap.bundle.min.js"></script>
<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../js/dashboard.js"></script>
<script>
    $("#btntaiter").click(function(e) {
        $("#formtaiter").submit();
    });
    $('.historique').addClass('active');
</script>

</html>