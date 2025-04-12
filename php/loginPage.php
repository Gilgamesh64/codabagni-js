<title>Login page</title>

<style>
    body {
        background-color: lightskyblue;
        text-align: center;
        justify-items: center;
        user-select: none;
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

    @media only screen and (max-width: 768px) {
    #form {
        zoom: 175%;
    }
  }
    form {
        background-color: cornflowerblue;
        color: white;
        zoom: 300%;
        width: fit-content;
        border: 5px solid blue;
        border-radius: 15px;
        justify-items: center;
        padding: 5px;
        box-shadow: 0px 5px 0px white;
        margin-top: 2%;
    }

    input {
        user-select: auto;
        border: 2px solid blue;
        background-color: lightgreen;
        border-radius: 15px;
        padding: 5px;
        transition: 0.3s;
        outline: none;
    }
    
    input:focus {
        border-color: blue;
    }
    input:not(:placeholder-shown):invalid {
        background-color: lightcoral;
        border-color: red;
        transition: 0.3s;
    }

    #login,
    #register {
        width: 45%;
        background-color: aquamarine;
        border: 2px solid blue;
        border-radius: 5px;
        margin-top: 2px;
        margin-inline: 2px;
    }

    #login:active,
    #register:active {
        background-color: blue;
        color: white;
    }
</style>
<div id="titoloContainer">
    <div id="titolo">Coda Bagni</div>
</div>
<form id="form" method="post">
    <label>User</label><br>
    <input type="text" name="userID" pattern="^\S+$" placeholder="Name" title="Name with no spaces." required /><br><br>
    <label>Password</label><br>
    <input type="password" name="userPassword" pattern="^\S+$" placeholder="Password" title="Password with no spaces." required /><br><br>
    <button type="submit" name="submit" id="login" value="login">Login</button>
    <button type="submit" name="submit" id="register" value="register">Register</button>
</form>
<?php
echo $rejected;
?>