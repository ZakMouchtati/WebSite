<?php
require_once("../../app/models/product.php");
session_start();
$Product = new product();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codearticle = $_POST['codearticle'] ?? "";
    $_SESSION['msg'] = $Product->deleteProduit($codearticle);
    // echo $_SESSION['msg'];
    header("location:Products.php");
}
