<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $form = $_FILES["imgprofile"]['tmp_name'];
    $to = './profiles/' . $_FILES["imgprofile"]['name'];
}
