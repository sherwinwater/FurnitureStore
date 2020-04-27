<?php
session_start();

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Furniture Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/sys11099/PHP/FurnitureStore/View/main.css" >
    </head>
    <body>
        <h1>Welcome to Furniture Store</h1>

        <ul>
           <li><a href="/sys11099/PHP/FurnitureStore/View/index.php">Home</a></li>

            <?php
            if (isset($_SESSION["user"])) {
                if ($_SESSION["user"] != "Guest") {
                    ?>
                    <li><a><? echo "Hi ".$_SESSION["user"] ?></a></li>
                   <li><a href="/sys11099/PHP/FurnitureStore/Controller/user/logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><a ><? echo "Hi Guest" ?></a></li>
                   <li><a href="/sys11099/PHP/FurnitureStore/Controller/user/login.php">Login</a></li>

                <?php } ?>
                <?php
            } else {
                ?>
              <li><a href="/sys11099/PHP/FurnitureStore/Controller/user/login.php">Login</a></li>
                <?php
            }
            ?>
            <li><a href="/sys11099/PHP/FurnitureStore/Controller/showProducts.php">Shopping </a></li>
            <li><a href="/sys11099/PHP/FurnitureStore/Controller/cart/cart.php">Cart</a></li>
            <li><a href="/sys11099/PHP/FurnitureStore/Controller/showOrder.php">Order</a></li>
        </ul>
    </body>
</html>
