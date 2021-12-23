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
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="icon" type="image/png" href="./img/Icon.jpeg" />
    <title>CheckOut</title>
</head>

<body>
    <?php
    require_once('entete.php');
    require_once(dirname(__FILE__) . "./app/models/Panier.php");
    require_once(dirname(__FILE__) . "./app/models/Client.php");
    if (isset($_SESSION['idclient'])) {
        $idclient = $_SESSION['idclient'];
    } else {
        header("Location:login.php");
        $_SESSION["redirectmeg"] = "Cette Page Nécessite Une Authentification";
        $_SESSION["namepage"] = "checkout";
    }
    $Client = new Client();
    $panier = new Panier();
    $total = 0;
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        foreach ($_POST['panier'] as $qte) {
            $id = array_search($qte, $_POST['panier']);
            $panier->add($id, $qte);
        }
    }
    foreach ($panier->GetAllItem() as $item) {
        $total += $item->prix * $item->qte;
    }

    $user = $Client->indetifiedClient($idclient);
    ?>
    <div class="container">
        <form action="validercommande.php" method="POST">
            <div class="row ">
                <div class="col-md-6 mx-auto mt-5 ">
                    <h4 class=" text-center text-uppercase bg-secondary p-1">
                        info personnelle
                    </h4>
                    <input type="text" value="<?php echo $user->id ?>" name="id_client" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom">Nom :</label>
                                <input type="text" name="nom" id="nom" class="form-control ms-1" value=" <?php echo $user->nom ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="prenom">Prenom :</label>
                                <input type="text" name="prenom" id="prenom" class="form-control ms-1" value="<?php echo $user->prenom ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" name="email" id="email" class="form-control ms-1" value="<?php echo $user->email ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tel">Tel :</label>
                                <input type="text" name="tel" id="tel" class="form-control ms-1" value="<?php echo $user->tel ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="adresse">Adresse :</label>
                                <input type="text" name="adresse" id="adresse" class="form-control ms-1" value="<?php echo $user->adresse ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12  text-center  mx-auto mt-2">
                            <a href="profile.php" class="text-center ">Update This Information</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" row">
                <div class="col-md-6 mx-auto mt-2 mx-auto">
                    <h4 class="text-center text-uppercase p-1 bg-secondary">
                        Payment Information
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="bg-light mt-3">
                        <input type="radio" name="paiment" id="creditcard" value="creditcard" class="mx-2">
                        <img src="./img/credit-card.svg" width="30" height="30" alt="" class="mx-2">
                        <label for="creditcard">Credit Card</label>
                    </div>
                    <div class="cart">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cardnumber">Card Number :</label>
                                    <input type="text" name="cardnumber" id="cardnumber" class="form-control ms-1" placeholder="1234 1234 1234">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="namecard">Name on Card :</label>
                                    <input type="text" name="namecard" id="namecard" class="form-control ms-1" placeholder="Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="dateexpiration">Date d'Expiration :</label>
                                    <input type="text" name="dateexpiration" id="dateexpiration" class="form-control ms-1" placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cvccode">CVC Code :</label>
                                    <input type="password" name="cvc" id="cvc" class="form-control ms-1" placeholder="&#9679;&#9679;&#9679;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light p-2 mt-3">
                        <input type="radio" name="paiment" id="cod" value="cod" class="mx-2">
                        <img src="./img/paypal.svg" width="30" height="30" alt="" class="mx-2">
                        <label for="cod">Paiment a la Livraison</label>
                    </div>
                    <div class="paypal">
                        <div class="col-md-6 mx-auto">
                            <a href="#">
                                <img src="./img/cc-paypal.svg" width="80" height="80" class="p-2" alt="paypal">
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mx-auto mt-5">
                            <button class="btn btn-success">
                                BUY NOW
                                <input type="text" value="<?php echo $total ?>" name="total" style="display: none;">
                                <?php
                                $total = $total ? $total + 100 : 0;
                                echo "<br>( $total MAD) ";
                                ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("footer.php") ?>
</body>

</html>