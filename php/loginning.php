<?php
$conn = mysqli_connect("localhost", "root", "", "codabagni");

if (false === $conn) {
    exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
}

$user = mysqli_fetch_assoc(doQuery($conn, "SELECT * FROM users WHERE name = ?;", "s", ...[$userID]));
$login = mysqli_fetch_assoc(doQuery($conn, "SELECT * FROM users WHERE name = ? AND password = ?;", "ss", ...[$userID, $userPassword]));
$token =  mysqli_fetch_assoc(doQuery($conn, "SELECT * FROM tokens WHERE name = ?;", "s", ...[$userID]));
$str = '';

if ($submit == "login") {
    if ($login) {
        $_SESSION['logged'] = true;
        $_SESSION['rejected'] = "";
        $tokenStr = randstr(16);
    if (!$token) {
        doQuery($conn, "INSERT INTO tokens VALUES(?, ?)", "ss", ...[$userID, $tokenStr]);
    } else {
        doQuery($conn, "UPDATE tokens SET token = ? WHERE name = ?", "ss", ...[$tokenStr, $userID]);
    }
    setcookie("userID", $userID, time() + (86400 * 30), "/");
    setcookie("token", $tokenStr, array(
        'expires' => time() + (86400 * 30),
        'path' => "/",
        'secure' => true,
    ));
    }else {
        $_SESSION['rejected'] = "<br>Password o Utente sbagliato.<br>";
    }
    header("Refresh:0");
} else if ($submit == "register") {
    if ($user) {
        $_SESSION['rejected'] = "<br>L'Utente esiste già!<br>";
    } else {
        doQuery($conn, "INSERT INTO users VALUES (?, ?);", "ss", ...[$userID, $userPassword]);
    }
    header("Refresh:0");
}
