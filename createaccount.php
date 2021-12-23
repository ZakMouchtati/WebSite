<?php
$status = null;
$profile = "./profiles/default.png";
session_start();
require_once(dirname(__FILE__) . "./app/models/client.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $adresse = $_POST['adresse'] ?? '';
    $tel = $_POST['tel'] ?? '';
    $password = $_POST['password'] ?? '';
    $mdp2 = $_POST['mdp2'] ?? '';
    if ($password === $mdp2) {
        $client = new Client();
        $password = md5($password);
        if (!isset($_FILES['imgprofile'])) {
            $form = $_FILES["imgprofile"]['tmp_name'];
            $to = '../profiles/' . $_FILES["imgprofile"]['name'];
            move_uploaded_file($form, $to);
            $profile = $to;
        }
        $_SESSION['msg'] = $client->newClient($nom, $prenom, $email, $adresse, $tel, $password, $profile);
    } else {
        $_SESSION['msg'] = 'Veuiller Confirmer Mot de Passe !!';
    }
}

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
    <link rel="icon" type="image/png" href="./img/Icon.jpeg" />
    <title>Create Account</title>
</head>

<body>
    <?php if (isset($_SESSION['msg'])) {  ?>
        <?php if ($_SESSION['msg'] !== null) {  ?>
            <div class="alert alert-success alert-dismissible fade show text-center text-uppercase " role="alert" style="position: absolute; width: 100%;z-index: 99;" id="alert">
                <strong><?php echo $_SESSION['msg'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
    <?php } ?>


    <div class="container contentfrom">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="logo text-center">
                <img src="./img/header.png" alt="logo">
            </div>
            <div>
                <div class="col-md-6 mx-auto mt-5 ">
                    <h4 class=" text-center text-uppercase bg-secondary p-1">
                        info personnelle
                    </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom">Nom :</label>
                                <input type="text" name="nom" id="nom" class="form-control ms-1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="prenom">Prenom :</label>
                                <input type="text" name="prenom" id="prenom" class="form-control ms-1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" name="email" id="email" class="form-control ms-1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tel">Tel :</label>
                                <input type="text" name="tel" id="tel" class="form-control ms-1">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="adresse">Adresse :</label>
                                <input type="text" name="adresse" id="adresse" class="form-control ms-1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password">Pasword :</label>
                                <input type="password" name="password" id="password" class="form-control ms-1">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mdp2">Confirm Password :</label>
                                <input type="password" name="mdp2" id="mdp2" class="form-control ms-1">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="picture">Picture</label>
                                <input type="file" name="imgprofile" id="picture" value="Edit Profile" class="form-control-file d-block">
                            </div>
                        </div>

                    </div>
                    <div class="text-center">
                        <a href="index.php" class="btn btn-dark mx-auto my-3 p-2">Back</a>
                        <button class="btn btn-success mx-auto my-3 p-2"> Create Account</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php unset($_SESSION['msg']) ?>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./css/bootstrap/bootstrap.bundle.min.js"></script>
    <script>
        window.setTimeout(function() {
            $("#alert").alert('close');
        }, 2000);
        $('.products').addClass('active');
    </script>
</body>

</html>