<?php
session_start();
include 'php/vars.php';
include 'php/utils.php';

include 'php/loginning.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    if (!$logged) {
        include 'php/loginPage.php';
        exit();
    }

    if (!str_starts_with($submit, "in")) {
        readfile('frontend/menu.html');
        exit();
    }

    $num = intval(substr($submit, 2));
    setcookie("bathroom", $num, time() + (86400 * 30), "/");
    readfile('frontend/index.html');
    ?>
</body>

</html>