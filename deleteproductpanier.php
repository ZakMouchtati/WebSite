<?php
require_once(dirname(__FILE__) . "./app/models/Panier.php");
session_start();
$panier = new Panier();
$id = $_GET['code'] ?? '';
$panier->deletePanier($id);
$_SESSION["msg"] = "Product Has Deleted In your panier";
$_SESSION["color"] = "danger";
header('location:panier.php');
