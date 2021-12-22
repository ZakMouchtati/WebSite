<?php
require_once('../app/models/product.php');
$product = new product();
$product->deleteImg($_GET['idimg']);
header("Location:updateproduit.php?code={$_GET["code"]}");
