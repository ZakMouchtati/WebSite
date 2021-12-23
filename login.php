<?php
$status = null;
require_once(dirname(__FILE__) . "./app/models/authentification.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['username'];
    $password = $_POST['mdp'] ?? '';
    $password = md5($password);
    $authentified = new authentification();
    $status = $authentified->authentified($email, $password);
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
    <title>Login</title>
</head>

<body>
    <!DOCTYPE html>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="./css/login.css">
        <link rel="icon" type="image/png" href="./img/Icon.jpeg" />
        <title>Login</title>
    </head>

    <body>
        <div class="container contentfrom">
            <form action="" method="POST">
                <div class="logo">
                    <img src="./img/header.png" alt="logo">
                </div>
                <?php if ($status !== null) { ?>
                    <div class="eroor">
                        <span><?php echo $status ?></span>
                    </div>
                <?php } else if (isset($_SESSION['redirectmeg'])) { ?>
                    <div class="eroor">
                        <span><?php echo $_SESSION['redirectmeg'] ?></span>
                    </div>
                <?php } else { ?>
                    <div class="empty">
                    </div>
                <?php } ?>
                <label>Username :</label>
                <input type="email" name="username" value="<?php echo $email ?? '' ?>">
                <label>Password :</label>
                <input type="password" name="mdp">
                <div class="btnrealtive">
                    <input type="submit" value="Login" class="connect">
                </div>
                <a href="createaccount.php" class="createaccount">Create New Account </a>
            </form>
        </div>

    </body>

    </html>
    <?php unset($_SESSION['redirectmeg']) ?>
</body>

</html>