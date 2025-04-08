<?php

$submit = '';
if (isset($_POST['submit'])) {
    $submit = $_POST['submit'];
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

$bathroom_id = 0;
if(isset($_POST["bathroom_id"])){
    $bathroom_id = $_POST["bathroom_id"];
}

// Sessions variables
$logged = false;
if (isset($_SESSION['logged'])) $logged = $_SESSION['logged'];

$rejected = '';
if (isset($_SESSION['rejected'])) $rejected = $_SESSION['rejected'];