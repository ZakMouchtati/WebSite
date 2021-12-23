<?php
require_once('../app/models/msg.php');
session_start();
$msg = new Msg();
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
    <title>Boite Message</title>
</head>

<body>
    <div class="d-flex bd-highlight">
        <div class="flex-shrink-1 bd-highlight" style="height: 100vh;position: fixed;">
            <?php require_once('aside.php') ?>
        </div>
        <div class="w-100 bd-highlight" style="margin-left: 280px;">
            <div class="title text-center">
                <a href="#" class="nav-link text-dark text-capitalize fs-3">
                    <svg class="bi me-2" width="25" height="25">
                        <use xlink:href="#chat-dots" />
                    </svg>
                    Boite Message
                </a>
            </div>
            <?php foreach ($msg->getmsg() as $msg) { ?>
                <div class="col-md-6 mx-auto bg-light p-3 my-1">
                    <div class="text-end">
                        <a href="deletemsg.php?msg=<?php echo $msg->id  ?>">
                            <img src="../img/times-circle.svg" class="rounded" width="20" height="20" alt="">
                        </a>
                    </div>
                    <h4><?php echo $msg->object ?></h4>
                    <span><?php echo $msg->email ?></span>
                    <p><?php echo $msg->contenu ?></p>
                </div>
            <?php } ?>
            <script src="../css/bootstrap/bootstrap.bundle.min.js"></script>
            <script src="../js/jquery-3.6.0.min.js"></script>
            <script>
                $('.boite').addClass('active');
            </script>
</body>

</html>