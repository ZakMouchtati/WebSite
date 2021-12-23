<?php
require_once('../app/models/msg.php');
$msg = new Msg();
$id = $_GET['msg'] ?? "";
$msg->deletemsg($id);
header("Location:boitemsg.php");
