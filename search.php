<?php
require_once(dirname(__FILE__) . './app/models/product.php');
$marque = $_GET['marque'] ?? '';
$libelle = $_GET['clelibelle'] ?? '';
$items = new Product();
$listItem = $items->searchproduct($marque, $libelle);

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
    <link rel="stylesheet" href="./css/Chercher.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" type="image/png" href="./img/Icon.jpeg" />
    <title>Accueil</title>
</head>

<body>
    <?php require_once('entete.php') ?>
    <?php if ($listItem !== null) { ?>
        <div class="items">
            <div class="container">
                <?php
                foreach ($listItem as $item) {
                ?>
                    <div class="card item">
                        <a href="" class="commander">
                            <div class="img">
                                <img src="<?php echo "./" . $item->path ?>" class="card-img-top" alt="product item">
                            </div>
                        </a>
                        <div class="card-body">
                            <a href="" class="commander">
                                <h5 class="card-title title"><?php echo $item->libelle; ?> </h5>
                                <p class="card-text prix"><?php echo $item->prix; ?></p>
                            </a>
                            <a href=<?php echo "./showProduct.php?code=$item->id " ?>class="btn btncommader">Commander Maintenant</a>
                        </div>
                    </div>
                <?php } ?>
                <div class="clearfix"></div>
            </div>
        </div>
    <?php } else { ?>
        <div class="container">
            <div class="empty">
                <h2 class="titre">Il n'y a pas de produits dans cette catégorie</h2>
                <img src="./img/empty.svg">
            </div>
        </div>
    <?php } ?>
    <?php require("footer.php") ?>
</body>

</html>