<?php
$conn = mysqli_connect("localhost", "root", "", "codabagni");

if (false === $conn) {
    exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
}

function activate($conn, $userID, $token)
{
    $_SESSION['logged'] = true;
    $_SESSION['rejected'] = "";
    $tokenStr = randstr(16);
    if (!$token) {
        doQuery($conn, "INSERT INTO tokens VALUES(?, ?)", "ss", $userID, $tokenStr);
    } else {
        doQuery($conn, "UPDATE tokens SET token = ? WHERE name = ?", "ss", $tokenStr, $userID);
    }
    setcookie("userID", $userID, time() + (86400 * 30), "/");
    setcookie("token", $tokenStr, array(
        'expires' => time() + (86400 * 30),
        'path' => "/",
        'httponly' => true,
    ));
    
    //'secure' => true,
}

$str = '';

if ($userID != "" && $userPassword != "") {
    $user = mysqli_fetch_assoc(doQuery($conn, "SELECT * FROM users WHERE name = ?;", "s", $userID));
    $login = mysqli_fetch_assoc(doQuery($conn, "SELECT * FROM users WHERE name = ? AND password = ?;", "ss", $userID, $userPassword));
    $token = mysqli_fetch_assoc(doQuery($conn, "SELECT * FROM tokens WHERE name = ?;", "s", $userID));

    if ($submit == "login") {
        if ($login && !$token) {
            activate($conn, $userID, $token);
        } else if ($token) {
            $tokenStr = $token["token"];
            doQuery($conn, "DELETE FROM tokens WHERE name = ? AND token = ?", "ss", $userID, $tokenStr);
            $_SESSION['rejected'] = "<br>Sessione scaduta.<br>";
        } else {
            $_SESSION['rejected'] = "<br>Password o Utente sbagliato.<br>";
        }
        header("Refresh:0");
    } else if ($submit == "register") {
        if ($user) {
            $_SESSION['rejected'] = "<br>L'Utente esiste già!<br>";
        } else {
            doQuery($conn, "INSERT INTO users VALUES (?, ?);", "ss", $userID, $userPassword);
            activate($conn, $userID, $token);
        }
        header("Refresh:0");
    }
} else if ($submit == "logout") {
    session_unset();
    session_destroy();

    if (isset($_COOKIE["userID"]) && isset($_COOKIE["token"])) {
        $user = $_COOKIE["userID"];
        $token = $_COOKIE["token"];
        doQuery($conn, "DELETE FROM tokens WHERE name = ? AND token = ?", "ss", $user, $token);
    }

    $past = time() - 3600;
    foreach ($_COOKIE as $key => $value) {
        setcookie($key, $value, $past, '/');
    }
    header("Refresh:0");
    exit();
}
