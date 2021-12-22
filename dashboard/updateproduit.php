<?php
require_once("../app/models/product.php");
require_once("../app/models/marque.php");
session_start();
$marques = new marque();
$Product = new product();
$id = $_GET['code'] ?? "";
$item = $Product->getOneProduct($id);
$images = $Product->GetsecondaireImg($id);
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $libelle = $_POST['libelle'] ?? $item->libelle;
    $qtestock = $_POST['qtestock'] ?? $item->qtestock;
    $prix = $_POST['prix'] ?? $item->prix;
    $marque = $_POST['marque'] ?? $item->marque_id;
    $description = $_POST['desc'] ?? $item->description;
    $path = $item->path;
    if ($_FILES['imgprincipal']['size'] > 0) {
        unlink("/../" . $path);
        $form = $_FILES['imgprincipal']['tmp_name'];
        $to = "../items/" . $_FILES['imgprincipal']['name'];
        move_uploaded_file($form, $to);
        $path = "items/" . $_FILES['imgprincipal']['name'];
    }
    $images = [];
    foreach ($_FILES['imgsecondaire']['error'] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $source = $_FILES['imgsecondaire']['tmp_name'][$key];
            $destination = "../items/" . $_FILES['imgsecondaire']['name'][$key];
            move_uploaded_file($source, $destination);
            $images = [...$images, "items/" . $_FILES['imgsecondaire']['name'][$key]];
        }
    }
    $_SESSION['msg'] = $Product->updateproduit($id, $libelle, $qtestock, $prix, $marque, $description, $path, $images);
    header("Location:Products.php");
}
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
    <title>Update Product</title>
</head>

<body>
    <div class="d-flex bd-highlight">
        <div class="flex-shrink-1 bd-highlight" style="height: 100vh;position: fixed;">
            <?php require_once('aside.php') ?>
        </div>
        <div class="w-100 bd-highlight" style="margin-left: 280px;">
            <div class="title text-center">
                <a href="Products.php" class="nav-link text-dark text-capitalize fs-3">
                    <svg class="bi me-2 " width="25" height="25">
                        <use xlink:href="#grid" />
                    </svg>
                    Update Product
                </a>
            </div>
            <div class="col-6 mx-auto">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="col-12 p-2">
                        <label for="libelle" class="form-label ms-1">Libelle du produit:</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" id="libelle" name="libelle" value="<?php echo $item->libelle ?>" required>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-6">
                            <label for="qtestock" class="form-label ms-1">Qte Stock du produit:</label>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control" id="qtestock" name="qtestock" value="<?php echo $item->qtestock ?>" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="prix" class="form-label ms-1">Prix du produit:</label>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control" id="prix" name="prix" value="<?php echo $item->prix ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <label for="marque" class="form-label ms-1">Marque du produit :</label>
                        <div class="has-validation">
                            <select name="marque" id="" class="form-select">
                                <?php foreach ($marques->index() as $marque) { ?>
                                    <?php if ($item->name !== $marque->name) { ?>
                                        <option value="<?php echo $marque->id ?>"><?php echo $marque->name ?> </option>
                                    <?php } else { ?>
                                        <option value="<?php echo $marque->id ?>" selected> <?php echo $marque->name ?> </option>
                                    <?php } ?>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <label for="desc" class="form-label ms-1">Description du produit :</label>
                        <div class="has-validation">
                            <textarea name="desc" id="desc" cols="30" rows="5" class="form-control"><?php echo $item->description ?></textarea>
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <label for="imgprincipal" class="form-label ms-1">Image Principal :</label>
                        <div class="has-validation">
                            <img src="<?php echo "../" . $item->path ?>" width="100px" alt="">
                            <input type="file" name="imgprincipal" id="imgprincipal" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <label for="desc" class="form-label ms-1">Images Secondaire :</label>
                        <div class="has-validation">
                            <?php foreach ($images as $img) { ?>
                                <img src="<?php echo "../" . $img->path ?>" width="100px" alt="">
                                <a href="deleteimg.php?idimg=<?php echo $img->id ?>&code=<?php echo $id ?>">
                                    <img src="../img/trash-alt.svg" alt="" width="20" height="20">
                                </a>
                            <?php } ?>
                        </div>
                        <div class="addmoreimg">
                            <input type="file" name="imgsecondaire[]" id="desc" class="form-control">
                        </div>
                        <div class="mt-2 text-center">
                            <img src="../img/plus-square.svg" alt="plus" height="25" width="25" id="more-img">
                        </div>

                    </div>
                    <div class="text-center mt-3">
                        <a href="Products.php" class="btn btn-md px-5 btn-primary mx-3">Cancel </a>
                        <button type="submit" class="btn btn-md px-5 btn-warning">Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../css/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $('.products').addClass('active');
        $("#more-img").click(function(e) {
            $('.addmoreimg').append('<input type="file" name="imgsecondaire[]" id="desc" class="form-control">')
        });
    </script>
</body>

</html>