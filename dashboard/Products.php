<?php
require_once("../app/models/product.php");
$produits = new Product();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <link rel="icon" type="image/png" href="/../img/Icon.jpeg" />
    <title>Document</title>
    <style>
        .bi {
            vertical-align: -.125em;
            pointer-events: none;
            fill: currentColor;
        }

        table tr td {
            vertical-align: middle !important;
        }
    </style>
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


    <div class="d-flex bd-highlight">
        <div class="flex-shrink-1 bd-highlight bg-danger" style="height: 100vh;position: fixed;">
            <?php require_once('aside.php') ?>
        </div>
        <div class="w-100 bd-highlight" style="margin-left: 280px;">
            <div class="title text-center">
                <a href="Products.php" class="nav-link text-dark text-capitalize fs-3">
                    <svg class="bi me-2 " width="25" height="25">
                        <use xlink:href="#grid" />
                    </svg>
                    Products
                </a>
            </div>
            <table class="table mt-5 text-center">
                <thead>
                    <tr>
                        <th>Image </th>
                        <th>Ref</th>
                        <th>Libelle</th>
                        <th>Marque</th>
                        <th>Qte Stock</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits->index() as $produit) { ?>
                        <tr>
                            <td><img src="<?php echo "../" . $produit->path ?>" alt="" width="90px" class="rounded mx-auto d-block"></td>
                            <td><?php echo $produit->id ?></td>
                            <td><?php echo $produit->libelle ?></td>
                            <td><?php echo $produit->name ?></td>
                            <td><?php echo $produit->qtestock ?></td>
                            <td><?php echo $produit->prix ?></td>
                            <td class="border-0">
                                <form action="deleteproduit.php" method="POST">
                                    <a href="updateproduit.php?code=<?php echo $produit->id ?>">
                                        <img src="../img/pencil-alt.svg" width="25" height="25" alt="imagesproduit">
                                    </a>
                                    <input type="hidden" value="<?php echo $produit->id  ?>" name="codearticle">
                                    <button type="submit" class="btn">
                                        <img src="../img/trash-alt.svg" width="25" height="25" alt="">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="text-center mt-3">
                <a href="addproduit.php" class="btn btn-block btn-success">Add New Produit</a>
            </div>
        </div>
    </div>


    <?php unset($_SESSION['msg']) ?>
    <script src="../css/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        window.setTimeout(function() {
            $("#alert").alert('close');
        }, 2000);
        $('.products').addClass('active');
    </script>
</body>

</html>