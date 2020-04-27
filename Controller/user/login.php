<?php
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore" . "/View/header.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore" . "/config/connect.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore" . "/Model/customer.php";

$userid = filter_input(INPUT_POST, "userid", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

$userid_guest = filter_input(INPUT_POST, "userid_guest", FILTER_SANITIZE_SPECIAL_CHARS);

$userid_new = filter_input(INPUT_POST, "userid_new", FILTER_SANITIZE_SPECIAL_CHARS);
$password_new = filter_input(INPUT_POST, "password_new", FILTER_SANITIZE_SPECIAL_CHARS);
$password_con_new = filter_input(INPUT_POST, "password_con_new", FILTER_SANITIZE_SPECIAL_CHARS);
$firstname_new = filter_input(INPUT_POST, "firstname_new", FILTER_SANITIZE_SPECIAL_CHARS);
$lastname_new = filter_input(INPUT_POST, "lastname_new", FILTER_SANITIZE_SPECIAL_CHARS);
$email_new = filter_input(INPUT_POST, "email_new", FILTER_SANITIZE_SPECIAL_CHARS);

//existing customer
$wrongmsg = "";
if (isset($userid) && isset($password)) {
    // validate user
    $customer = new Customer($conn);
    if ($customer->checkExistingCustomer($userid, $password)) {
        $_SESSION['user'] = $userid;
        echo "<script type='text/javascript'>
     window.open('http://192.168.64.2/sys11099/PHP/FurnitureStore/Controller/showProducts.php');
     </script>";
    } else {
        $wrongmsg = "wrong user with password";
    }
}

//guest
if (isset($userid_guest)) {
    $_SESSION["user"] = $userid_guest;
    $pageurl = "/sys11099/PHP/FurnitureStore/Controller/showProducts.php";
    echo "<script type='text/javascript'>
     window.open('http://192.168.64.2/sys11099/PHP/FurnitureStore/Controller/showProducts.php');
     </script>";
}
//new customer
$outmsg = array("","");
if (isset($userid_new) && isset($password_new) && isset($password_con_new) && isset($firstname_new) && isset($lastname_new) && isset($email_new)) {
    $params = array($userid_new, $password_new, $firstname_new, $lastname_new, $email_new);
    $customer = new Customer($conn);
    $outmsg = $customer->checkDuplicateCustomer($userid_new, $email_new);
    
    if ($outmsg[0] == false) {
        $customer->insertCustomer($params);
        $_SESSION["user"] = $userid_new;
    }
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
        <form method='post' action='login.php'>
            <input type='text' name='userid' placeholder='userid' required autofocus><br>
            <input type='password' name='password' placeholder='password' required><br>       
            <input type='submit' value='Login'><br>
            <p style="color: red"><?= $wrongmsg ?></p>
        </form>
        <form method='post' action='login.php'>
            <input type='text' name='userid_guest' value='guest' hidden><br>
            <input type='submit' value='Login As Guest'>
        </form>

        <h3>Create new account</h3>
        <form method='post' action='login.php'>
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
