<?php
require(dirname(__FILE__) . "./app/models/product.php");
$article = new Product();
$id_article = $_GET["code"] ?? header("Location:index.php");
$item = $article->getOneProduct($id_article);
$items = $article->show();
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
    <link rel="stylesheet" href="./css/product.css">
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="icon" type="image/png" href="./img/Icon.jpeg" />
    <title>Product</title>
    <style>
        .imgselected {
            filter: blur(3px);
            -webkit-filter: blur(3px);
        }
    </style>
</head>

<body>
    <?php require_once('entete.php') ?>
    <div class="product">
        <div class="container">
            <h4 class="product-title"><?php echo $item->libelle; ?></h4>
            <div class="image-poduct">
                <img src="<?php echo "./" . $item->path; ?>" alt="product img principal" id="firstimg" />
                <div style="display: flex;">
                    <div class="#" style="width: 120px;">
                        <img src="<?php echo "./" . $item->path; ?>" class="secondimg" alt="product img secondimg" />
                    </div>
                    <?php foreach ($article->GetsecondaireImg($id_article) as $imgsecond) {
                    ?>
                        <div class="#" style="width: 120px;">
                            <img src="<?php echo "./" . $imgsecond->path ?>" alt="product img secondimg" class="secondimg">
                        </div>
                    <?php } ?>
                </div>

            </div>
            <div class="product-info">
                <span class="product-price"><?php echo $item->prix; ?></span>
                <form action="panier.php" method="POST">
                    <input type="hidden" value="<?php echo $item->id ?>" name="code">
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <img src="./img/minus-square.svg" id="moins" height="25" width="25" alt="">
                            <input class="mx-1" id="qte" value="1" name="qte" class="qte">
                            <img src="./img/plus-square.svg" id="plus" alt="" height="25" width="25">
                        </div>
                    </div>
                    <button class="Btn-Commandez btn btn-warning">Ajouter Au Panier</button>
                </form>

                <hr />
                <div class="product-desc">
                    <p><?php echo $item->description ?></p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="clearfix"></div>
        <h5 class="more my-5">Produits apparentés</h5>
        <div class="items my-3">
            <div class="container">
                <?php
                foreach ($items as $item) {
                    include('./_Oneproduit.php');
                } ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php require_once("./footer.php") ?>
</body>

</html>