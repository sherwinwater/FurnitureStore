<?php
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/View/header.php";

?>
<!DOCTYPE html>
<html>
    <body>
        <p>Hi <?= isset($_SESSION["user"])?$_SESSION["user"]:"guest" ?>, You have logged out. </p>
        <a  href="/sys11099/PHP/FurnitureStore/Controller/user/login.php" class="add checkout"> Login</a><br>
        <?php 
        session_destroy();
        ?>

    </body>
</html>
