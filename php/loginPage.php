<title>Login page</title>

<style>
    body {
        background-color: lightskyblue;
        text-align: center;
        justify-items: center;
    }
    
    #titoloContainer {
    display: flex;
    justify-content: center;
}

#titolo {
    color: white;
    text-shadow: 2px 3px 0px black;
    font-weight: bolder;
    font-size: 72px;
}

    form {
        background-color: cornflowerblue;
        color: white;
        zoom: 200%;
        width: fit-content;
        border: 5px solid blue;
        border-radius: 25px;
        justify-items: center;
        padding: 5px;
        box-shadow: 0px 5px 0px white;
        margin-top: 2%;
    }

    input:invalid {
        background-color: aquamarine;
    }

    #login,
    #register {
        background-color: aquamarine;
        border: 3px solid blue;
        border-radius: 100px;
        margin-top: 2px;
        margin-inline: 2px;
    }
</style>
<div id="titoloContainer">
    <div id="titolo">Coda Bagni</div>
</div>  
<form method="post">
                <label>User</label><br>
                <input type="text" name="userID" pattern="^\S+$" required /><br><br>
                <label>Password</label><br>
                <input type="password" name="userPassword" pattern="^\S+$" required /><br><br>
    <button type="submit" name="submit" id="login" value="login">Login</button>
    <button type="submit" name="submit" id="register" value="register">Register</button>
</form>
<?php
echo $rejected;
?>