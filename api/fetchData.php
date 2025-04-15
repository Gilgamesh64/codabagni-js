<?php

$action = '';
$user = '';
$token = '';
$bathroom = '';

if (isset($_POST['operation'])) {
    $action = $_POST['operation'];
}
if (isset($_COOKIE["userID"])) {
    $user = $_COOKIE["userID"];
}
if (isset($_COOKIE["token"])) {
    $token = $_COOKIE["token"];
}
if (isset($_COOKIE["bathroom"])) {
    $bathroom = $_COOKIE["bathroom"];
}
