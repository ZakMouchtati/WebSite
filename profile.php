<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="stylesheet" href="./css/profile.css" />
    <link rel="icon" type="image/png" href="./img/Icon.jpeg" />
    <title>Profile</title>
</head>

<body>
    <?php
    require_once('entete.php');
    require_once(dirname(__FILE__) . './app/models/client.php');
    $Client = new Client();
    if (isset($_SESSION['idclient'])) {
        $id = $_SESSION['idclient'];
    } else {
        header("Location:login.php");
        $_SESSION["redirectmeg"] = "Cette Page Nécessite Une Authentification";
        $_SESSION["namepage"] = "profile";
    }
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $path = $user->profile;
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';
        $adresse = $_POST['adresse'] ?? '';
        $tel = $_POST['tel'] ?? '';
        $id = $_POST['idclient'] ?? '';
        if (isset($_FILES['imgprofile'])) {
            if ($path !== "../profiles/default.png") {
                unlink($path);
            }
            $form = $_FILES["imgprofile"]['tmp_name'];
            $path = "../profiles/$id-" . $_FILES["imgprofile"]['name'];
            move_uploaded_file($form, $path);
        }
        $Client->UpdateClient($id, $nom, $prenom, $email, $tel, $adresse, $path);
    }
    $user = $Client->indetifiedClient($id);
    ?>
    <?php include('./_alert.php') ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="container bootstrap snippets bootdey">
            <div class="panel-body inf-content">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo $user->profile ?>" alt="" style="width:600px;" title="" class="img-circle img-thumbnail isTooltip" data-original-title="Usuario">
                        <input type="button" name="imgprofile" value="Edit Profile" class="btn btn-md btn-success editProfile">
                        <input type="text" value="<?php echo $user->id_client ?>" name="idclient" style="display: none;">
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
                                                <span class="glyphicon glyphicon-asterisk text-primary"></span>
                                                Identificacion
                                            </strong>
                                        </td>
                                        <td class="text-secondary">
                                            <?php echo $user->id ?>
                                            <input type="text" value="<?php echo $user->id ?>" name="idclient" style="display: none;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-user  text-primary"></span>
                                                Nom :
                                            </strong>
                                        </td>
                                        <td class="text-secondary">
                                            <div class="showuser">
                                                <?php echo $user->nom ?>
                                                <button type="button" class="modifier-info">Modifier</button>
                                            </div>
                                            <div class="show-updated">
                                                <input type="text" value="<?php echo $user->nom ?>" name="nom">
                                                <button type="submit" class="btn btn-success btn-sm my-3 btn-modifier mx-2">Save </button>
                                                <button type="button" class="btn btn-secondary btn-sm my-3 btn-cancel">Cancel</button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class=" glyphicon glyphicon-cloud text-primary"></span>
                                                Prenom :
                                            </strong>
                                        </td>
                                        <td class="text-secondary">
                                            <div class="showuser">
                                                <?php echo $user->prenom ?>
                                                <button type="button" class="modifier-info">Modifier</button>
                                            </div>
                                            <div class="show-updated">
                                                <input type="text" value="<?php echo $user->prenom ?>" name="prenom">
                                                <button type="submit" class="btn btn-success btn-sm my-3 btn-modifier mx-2">Save </button>
                                                <button type="button" class="btn btn-secondary btn-sm my-3 btn-cancel">Cancel</button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-bookmark text-primary"></span>
                                                Email :
                                            </strong>
                                        </td>
                                        <td>
                                            <div class="showuser">
                                                <?php echo $user->email ?>
                                                <button type="button" class="modifier-info">Modifier</button>
                                            </div>
                                            <div class="show-updated">
                                                <input type="email" value="<?php echo $user->email ?>" name="email">
                                                <button type="submit" class="btn btn-success btn-sm my-3 btn-modifier mx-2">Save </button>
                                                <button type="button" class="btn btn-secondary btn-sm my-3 btn-cancel">Cancel</button>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-eye-open text-primary"></span>
                                                Tel :
                                            </strong>
                                        </td>
                                        <td class="text-secondary">
                                            <div class="showuser">
                                                <?php echo $user->tel ?>
                                                <button type="button" class="modifier-info">Modifier</button>
                                            </div>
                                            <div class="show-updated">
                                                <input type="text" value="<?php echo $user->tel ?>" name="tel">
                                                <button type="submit" class="btn btn-success btn-sm my-3 btn-modifier mx-2">Save </button>
                                                <button type="button" class="btn btn-secondary btn-sm my-3 btn-cancel">Cancel</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-envelope text-primary"></span>
                                                Adresse :
                                            </strong>
                                        </td>
                                        <td class="text-secondary">
                                            <div class="showuser">
                                                <?php echo $user->adresse ?>
                                                <button type="button" class="modifier-info">Modifier</button>
                                            </div>
                                            <div class="show-updated">
                                                <input type="text" value="<?php echo $user->adresse ?>" name="adresse">
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
    <?php include("footer.php") ?>
    <?php unset($_SESSION["msg"]) ?>
</body>

</html>