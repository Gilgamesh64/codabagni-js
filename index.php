<?php
session_start();
include 'php/vars.php';
include 'php/utils.php';

if ($submit == "logout") {
    session_unset();
    session_destroy();

    $past = time() - 3600;    
    foreach ( $_COOKIE as $key => $value ){
        setcookie( $key, $value, $past, '/' );
    }
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