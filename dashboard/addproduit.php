<?php
require_once('../app/models/marque.php');
require_once('../app/models/product.php');
session_start();
$marques = new Marque();
$produit = new Product();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $form = $_FILES['imgprincipal']['tmp_name'];
    $to = "../items/" . $_FILES['imgprincipal']['name'];
    move_uploaded_file($form, $to);
    $src = "items/" . $_FILES['imgprincipal']['name'];
    $images = [];
    foreach ($_FILES['imgsecondaire']['error'] as $key => $error) {

        if ($error == UPLOAD_ERR_OK) {
            $source = $_FILES['imgsecondaire']['tmp_name'][$key];
            $destination = "../items/" . $_FILES['imgsecondaire']['name'][$key];
            $path = "items/" . $_FILES['imgsecondaire']['name'][$key];
            move_uploaded_file($source, $destination);
            $images = [...$images, $path];
        }
    }
    $libelle = $_POST['libelle'] ?? "";
    $qtestock = $_POST['qtestock'] ?? "";
    $prix = $_POST['prix'] ?? "";
    $marque = $_POST['marque'] ?? "";
    $description = $_POST['desc'] ?? "";
    $_SESSION['msg'] = $produit->addproduit($libelle, $qtestock, $prix, $marque, $description, $src, $images);
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

        .bluur {
            filter: blur(1.5rem);
        }

        div {
            z-index: 1;
        }

        #form-marque {
            height: 100vh;
            width: 50%;
            display: none;
            z-index: 99;
            margin: auto;
            border: 1px solid #000;
            text-align: center;
            padding: 10px 20px;
        }
    </style>
    <title>Add NEW ARTICLE</title>
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
                    ADD Products
                </a>
            </div>
            <div class="col-6 mx-auto">
                <form action="" id="form-marque">
                    <h2>Add Produit</h2>
                    <input type="text">
                    <input type="submit">
                </form>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="col-12 p-2">
                        <label for="libelle" class="form-label ms-1">Libelle du produit:</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" id="libelle" name="libelle" required>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-6">
                            <label for="qtestock" class="form-label ms-1">Qte Stock du produit:</label>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control" id="qtestock" name="qtestock" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="prix" class="form-label ms-1">Prix du produit:</label>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control" id="prix" name="prix" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <label for="marque" class="form-label ms-1">Marque du produit :</label>
                        <div class="has-validation">
                            <select name="marque" id="" class="form-select">
                                <?php foreach ($marques->index() as $marque) { ?>
                                    <option value="<?php echo $marque->id ?>"><?php echo $marque->name ?> </option>
                                <?php } ?>
                            </select>
                            <button class="btn btn-success text-center" id="btn-marque" type="button">
                                Add New Marque
                            </button>
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <label for="desc" class="form-label ms-1">Description du produit :</label>
                        <div class="has-validation">
                            <textarea name="desc" id="desc" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <label for="imgprincipal" class="form-label ms-1">Image Principal :</label>
                        <div class="has-validation">
                            <input type="file" name="imgprincipal" id="imgprincipal" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <label for="desc" class="form-label ms-1">Images Secondaire :</label>
                        <div class="has-validation">
                            <input type="file" name="imgsecondaire[]" id="desc" class="form-control">
                            <input type="file" name="imgsecondaire[]" id="desc" class="form-control">
                            <input type="file" name="imgsecondaire[]" id="desc" class="form-control">
                            <input type="file" name="imgsecondaire[]" id="desc" class="form-control">
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-md px-5 btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../css/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $('.products').addClass('active');
    </script>
    <script>
        $('#btn-marque').click(function() {

            $('#form-marque').simpleAlert('messge hello')
            $(this).parent().addClass('bluur')

        })
    </script>
</body>

</html>