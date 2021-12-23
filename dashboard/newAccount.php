<?php
require_once('../app/models/admin.php');
session_start();
$admin = new admin();
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $password = $_POST['password'];
    $confirm = $_POST['confimpassword'];
    if ($password !== $confirm) {
        $_SESSION['msg'] = "Veuiller Confirmer Votre Mot de passe";
        header('location:newAccount.php');
    }
    $_SESSION['msg'] = $admin->newadmin($nom, $prenom, $email, $tel, md5($password));
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
    <title>New Account </title>
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
    <div class="d-flex bd-highlight">
        <div class="flex-shrink-1 bd-highlight" style="height: 100vh;position: fixed;">
            <?php require_once('aside.php') ?>
        </div>
        <div class="w-100 bd-highlight" style="margin-left: 280px;">
            <form action="" method="POST">

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
                                    <label for="confimpassword">Confirm Password :</label>
                                    <input type="password" name="confimpassword" id="confimpassword" class="form-control ms-1">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success mx-auto my-3 p-2"> Create Account</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php unset($_SESSION['msg']) ?>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../css/bootstrap/bootstrap.bundle.min.js"></script>
    <script>
        window.setTimeout(function() {
            $("#alert").alert('close');
        }, 4000);
    </script>
</body>

</html>