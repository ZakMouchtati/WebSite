<?php
require_once('../app/models/admin.php');
session_start();
$admins = new admin();
if (!isset($_SESSION["admin"])) {
    $admins->redirect('login');
    die();
}
$admin = $admins->indetifiedadmin($_SESSION['admin']);
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $path = $admin->profile;
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $oldpassword = md5($_POST['old']);
    $newpassword = md5($_POST['new']);
    $confirmpassword = md5($_POST['confirm']);
    if ($oldpassword !== $newpassword && $newpassword !== $confirmpassword) {
        $_SESSION['msg'] = "Veuiller Confirmer Votre Mot de passe";
        header('location:profileadmin.php');
    }
    if (isset($_FILES['imgprofile'])) {
        if ($path !== "../profiles/default.png") {
            unlink($path);
        }
        $form = $_FILES["imgprofile"]['tmp_name'];
        $path = "../profiles/admin-" . $_FILES["imgprofile"]['name'];
        move_uploaded_file($form, $path);
    }
    $_SESSION['msg'] = $admins->updateadmin($_SESSION['admin'], $nom, $prenom, $email, $tel, $newpassword, $path);
}

$admin = $admins->indetifiedadmin($_SESSION['admin']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/profile.css" />
    <link rel="icon" type="image/png" href="../img/Icon.jpeg" />
    <style>
        .bi {
            vertical-align: -.125em;
            pointer-events: none;
            fill: currentColor;
        }
    </style>
    <title>Profile</title>
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
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="container bootstrap snippets bootdey">
                    <div class="panel-body inf-content">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?php echo $admin->profile ?>" alt="" style="width:600px;" title="" class="img-circle img-thumbnail isTooltip" data-original-title="Usuario">
                                <input type="button" name="imgprofile" value="Edit Profile" class="btn btn-md btn-success editProfile">
                                <input type="text" value="" name="idclient" style="display: none;">
                                <button type="submit" class="btn btn-success btn-sm my-3 btn-modifier mx-2 btnprofile">Save </button>
                                <button type="button" class="btn btn-secondary btn-sm my-3 btn-cancel cancelprofile">Cancel</button>
                            </div>
                            <div class="col-md-6">
                                <strong>Information</strong><br>
                                <div class="table-responsive">
                                    <table class="table table-user-information">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        <span class="glyphicon glyphicon-user  text-primary"></span>
                                                        Nom :
                                                    </strong>
                                                </td>
                                                <td class="text-secondary">
                                                    <div class="showuser">
                                                        <?php echo $admin->nom ?>
                                                        <button type="button" class="modifier-info">Modifier</button>
                                                    </div>
                                                    <div class="show-updated">
                                                        <input type="text" value="<?php echo $admin->nom ?>" name="nom">
                                                        <button type="submit" class="btn btn-success btn-sm my-3 btn-modifier mx-2">Save </button>
                                                        <button type="button" class="btn btn-secondary btn-sm my-3 btn-cancel">Cancel</button>

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        <span class="glyphicon glyphicon-user  text-primary"></span>
                                                        Prenom :
                                                    </strong>
                                                </td>
                                                <td class="text-secondary">
                                                    <div class="showuser">
                                                        <?php echo $admin->prenom ?>
                                                        <button type="button" class="modifier-info">Modifier</button>
                                                    </div>
                                                    <div class="show-updated">
                                                        <input type="text" value="<?php echo $admin->prenom ?>" name="prenom">
                                                        <button type="submit" class="btn btn-success btn-sm my-3 btn-modifier mx-2">Save </button>
                                                        <button type="button" class="btn btn-secondary btn-sm my-3 btn-cancel">Cancel</button>

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        <span class="glyphicon glyphicon-user  text-primary"></span>
                                                        Email :
                                                    </strong>
                                                </td>
                                                <td class="text-secondary">
                                                    <div class="showuser">
                                                        <?php echo $admin->email ?>
                                                        <button type="button" class="modifier-info">Modifier</button>
                                                    </div>
                                                    <div class="show-updated">
                                                        <input type="text" value="<?php echo $admin->email ?>" name="email">
                                                        <button type="submit" class="btn btn-success btn-sm my-3 btn-modifier mx-2">Save </button>
                                                        <button type="button" class="btn btn-secondary btn-sm my-3 btn-cancel">Cancel</button>

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        <span class="glyphicon glyphicon-user  text-primary"></span>
                                                        Tel :
                                                    </strong>
                                                </td>
                                                <td class="text-secondary">
                                                    <div class="showuser">
                                                        <?php echo $admin->tel ?>
                                                        <button type="button" class="modifier-info">Modifier</button>
                                                    </div>
                                                    <div class="show-updated">
                                                        <input type="text" value="<?php echo $admin->tel ?>" name="tel">
                                                        <button type="submit" class="btn btn-success btn-sm my-3 btn-modifier mx-2">Save </button>
                                                        <button type="button" class="btn btn-secondary btn-sm my-3 btn-cancel">Cancel</button>

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        <span class="glyphicon glyphicon-user  text-primary"></span>
                                                        Password:
                                                    </strong>
                                                </td>
                                                <td class="text-secondary">
                                                    <div class="showuser">
                                                        <button type="button" class="modifier-info">Modifier</button>
                                                    </div>
                                                    <div class="show-updated">
                                                        <input type="password" name="old" placeholder="Old password" class="my-2">
                                                        <input type="password" name="new" placeholder="New password" class="my-2">
                                                        <input type="password" name="confirm" placeholder="Confirm password" class="my-2">
                                                        <button type="submit" class="btn btn-success btn-sm my-3 btn-modifier mx-2">Save </button>
                                                        <button type="button" class="btn btn-secondary btn-sm my-3 btn-cancel">Cancel</button>

                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php unset($_SESSION['msg']) ?>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../css/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/Custoum.js"></script>
    <script>
        window.setTimeout(function() {
            $("#alert").alert('close');
        }, 5000);
    </script>
</body>

</html>