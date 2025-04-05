<title>Login page</title>

<style>
    body {
        text-align: center;
        justify-items: center;
    }

    form {
        border: 2px inset blueviolet;
        justify-items: center;
        padding: 5px;
        box-shadow: 4px 4px 3px black;
        margin-top: 2%;
    }

    input:invalid {
        background-color: lightpink;
    }

    #login,
    #register {
        margin-top: 2px;
        margin-inline: 2px;
    }
</style>

<form method="post">
    <table>
        <tr>
            <td>
                <label>User</label>
            </td>
            <td>
                <input type="text" name="userID" pattern="^\S+$" required />
            </td>
        </tr>
        <tr>
            <td>
                <label>Password</label>
            </td>
            <td>
                <input type="password" name="userPassword" pattern="^\S+$" required />
            </td>
        </tr>
    </table>
    <button type="submit" name="submit" id="login" value="login">Login</button>
    <button type="submit" name="submit" id="register" value="register">Register</button>
</form>
<?php
echo $rejected;
?>