<?php

$submit = '';
if (isset($_POST['submit'])) {
    $submit = $_POST['submit'];
}

if (isset($_COOKIE['session'])) {
    if ($_COOKIE['session'] == "expired") {
        $submit = 'logout';
        setcookie("session", "");
    }
}

// Login form
$userID = '';
if (isset($_POST['userID'])) {
    $userID = $_POST['userID'];
}

$userPassword = '';
if (isset($_POST['userPassword'])) {
    $userPassword = $_POST['userPassword'];
}

// Sessions variables
$logged = false;
if (isset($_SESSION['logged'])) $logged = $_SESSION['logged'];

$rejected = '';
if (isset($_SESSION['rejected'])) $rejected = $_SESSION['rejected'];
