<?php
session_start();
include 'php/vars.php';
include 'php/utils.php';

if ($submit == "logout") {
    session_unset();
    session_destroy();
    header("Refresh:0");
    return;
}

if ($userID != "" && $userPassword != "") {
    include 'php/loginning.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    if ($logged) {
        readfile('index.html');
    } else {
        include 'php/loginPage.php';
    }
    ?>
</body>

</html>