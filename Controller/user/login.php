<?php
if (!isset($_SESSION)) {
    session_start();
}
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore" . "/View/header.php";

if (!isset($wrongmsg)) {
    $wrongmsg = "";
}

if (!isset($outmsg[1])) {
    $outmsg[1] = "";
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <h3>Log In</h3>
        <form method='post' action='login_validate.php'>
            <input type='text' name='userid' placeholder='userid' required autofocus><br>
            <input type='password' name='password' placeholder='password' required><br>       
            <input type='submit' value='Login'><br>
            <p style="color: red"><?= $wrongmsg ?></p>
        </form>
        <form method='post' action='login_validate.php'>
            <input type='text' name='userid_guest' value='Guest' hidden><br>
            <input type='submit' value='Login As Guest'>
        </form>

        <h3>Create new account</h3>
        <form method='post' action='login_validate.php'>
            <input type='text' name='userid_new' placeholder='userid' required autofocus><br>
            <input type='password' name='password_new' placeholder='password' required><br> 
            <input type='password' name='password_con_new' placeholder='confirm password' required><br> 
            <input type='text' name='firstname_new' placeholder='firstname'  ><br>
            <input type='text' name='lastname_new' placeholder='lastname'  ><br>
            <input type='email' name='email_new' placeholder='email'  ><br>
            <input type='submit' value='Signup'><br>
            <p style="color: red"><?= $outmsg[1] ?></p>

        </form>
        <br>
    </body>
</html>
