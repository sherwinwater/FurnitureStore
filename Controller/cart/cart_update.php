<?php
session_start();
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/View/header.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/config/connect.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/Model/product.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore" . "/Controller/cart/showCart.php";

$product = new Product($conn);
$columnNames = $product->getColumnNames();

$i=0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {

        if (isset($_GET['id' . $i])) {
            $value['quantity'] = $_GET['quantity' . $i];
            $_SESSION['cart_update'][$key] = $value;
        }
        $i++;
    }
    $_SESSION['cart'] = $_SESSION['cart_update'];
}
showCart("hidden","");

?>
<!DOCTYPE html>

<html>

    <body>
        <?php
        if ($_SESSION['totalprice']> 0) {
            ?>
            <h2>Hi <?= isset($_SESSION["user"])?$_SESSION["user"]:"guest" ?>, Your shopping cart</h2>
            <?= $cart_table ?>
            <a href="/sys11099/PHP/FurnitureStore/Controller/payment.php" class="buy" id="checkout">Proceed to Checkout </a>
        <?php } else {
            ?>
            <p>Hi <?= isset($_SESSION["user"])?$_SESSION["user"]:"guest" ?>,You haven't chosen any product</p>
        <?php }
        ?>