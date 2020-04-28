<?php
session_start();
$user = isset($_SESSION["user"])?$_SESSION["user"]:"Guest";
unset($_SESSION['user']);
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/View/header.php";

?>
<!DOCTYPE html>
<html>
    <body>
        <p>Hi <?= $user ?>, You have logged out. </p>
        <a  href="/sys11099/PHP/FurnitureStore/Controller/user/login.php" class="add checkout"> Login</a><br>
        <?php 
        session_destroy();
        ?>

    </body>
</html>
