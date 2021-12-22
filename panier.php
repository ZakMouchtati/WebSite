<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="site web sepacilse de vendu des pieces auto de qualite avec un petit prix">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./css/panier.css">
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="icon" type="image/png" href="./img/Icon.jpeg" />
    <title>Panier</title>
</head>

<body>
    <?php
    require_once('entete.php');
    require_once(dirname(__FILE__) . '../app/models/Panier.php');
    $panier = new Panier();
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $panier->add($_POST['code'], $_POST['qte']);
    }
    include('./_alert.php');
    $list = $panier->GetAllItem();
    $nbrarticle = 0;
    $total = 0;
    if ($list !== null) {
        foreach ($list as $qte) {
            $nbrarticle += $qte->qte;
            $total += $qte->prix * $qte->qte;
        }
    }
    $nbrarticle > 1 ? $nbrarticle = $nbrarticle . " articles" : $nbrarticle = $nbrarticle . " article";
    ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 bg-light ">
                <div class="tablepanier">
                    <h2>panier</h2>
                    <table>
                        <?php
                        if ($list == null) {
                            echo "<p>votre panier vide</p>";
                        } else {

                        ?>
                            <form action="checkout.php" method="POST" id="chekoutform">
                                <input type="text" value="<?php echo $total + 100 ?>" name="total" style="display: none;">
                                <?php foreach ($list as $item) {  ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo './' . $item->path ?>" alt="image" class="imgproduct">
                                        </td>
                                        <td>
                                            <?php echo $item->libelle ?>
                                        </td>
                                        <td>
                                            <?php echo $item->prix . " MAD" ?>
                                        </td>
                                        <td>
                                            <div class="col-md-12">
                                                <img src="./img/minus-square.svg" class="moins" height="25" width="25" alt="moins">
                                                <input class="mx-1" value="<?php echo $item->qte ?>" name="panier[<?php echo $item->id ?>]" class="qte">
                                                <img src="./img/plus-square.svg" class="plus" alt=plus"" height="25" width="25">
                                            </div>
                                        </td>
                                        <td>
                                            <a href="deleteproductpanier.php?code=<?php echo $item->id ?>">
                                                <img src="./img/trash-alt.svg" width="25" height="25" alt="delete produit">
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </form>
                        <?php } ?>
                    </table>
                    <a href="./">
                        <img src="./img/arrow-left.svg" alt="More" title="More Shopping" class="rounded mx-auto d-block mt-5" width="30px">
                    </a>
                </div>
            </div>
            <div class="col-md-3 ms-5 bg-light">
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

                    <div class="row">
                        <div class="col-md-6 mx-auto p-3">
                            <?php if ($total > 0) { ?>
                                <button id="passchekout" class="Btn-Commandez btn btn-warning rounded p-2 text-uppercase">commander</button>
                            <?php } else { ?>
                                <button id="passchekout" class="Btn-Commandez btn btn-warning rounded p-2 text-uppercase" disabled>commander</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('footer.php') ?>
</body>

</html>