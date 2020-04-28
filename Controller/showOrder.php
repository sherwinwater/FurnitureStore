<?php
session_start();
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/View/header.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore" . "/Controller/cart/showCart.php";
showCart("hidden","");
?>

<!DOCTYPE html>

<html>
    <body>
        <?php
        if (isset($_SESSION['orderid'])) {
            ?>
            <p>Hi <?= $_SESSION['user'] ?>, Your Order ID <?= $_SESSION['orderid'] ?></p>
            <?= $cart_table ?>

            <p>Delivery Information</p>
            <div class="order_deliveryinfo">
                <p>Recipient:<a><?= $_SESSION['delivery']['firstname_delivery'] . " " . $_SESSION['delivery']['lastname_delivery'] ?></a></p>
                <p>Email:<a><?= $_SESSION['delivery']['email_delivery'] ?></a></p>
                <p>Phone:<a><?= $_SESSION['delivery']['phone_delivery'] ?></a></p>
                <p>Delivery address:<a><?=
                        $_SESSION['delivery']['address_delivery'] . "," . $_SESSION['delivery']['city_delivery']
                        . "," . $_SESSION['delivery']['country_delivery'] . "," . $_SESSION['delivery']['postcode_delivery']
                        ?></a></p>
            </div>

            <p>Billing Information</p>
            <div class="order_deliveryinfo">
                <p>Name:<a><?= $_SESSION['billing']['firstname_payment'] . " " . $_SESSION['billing']['lastname_payment'] ?></a></p>
                <p>Billing address:<a><?=
                        $_SESSION['billing']['address_payment'] . "," . $_SESSION['billing']['city_payment']
                        . "," . $_SESSION['billing']['country_payment'] . "," . $_SESSION['billing']['postcode_payment']
                        ?></a></p>
            </div>

        <?php
        } else {
            if (isset($_SESSION['user'])) {
                ?>

                <p> Hi <?= $_SESSION['user'] ?>, You haven't place any orders </p>
    <?php } else { ?>
                <p> Hi Guest, You haven't place any orders </p>

            <?php } ?>
<?php } ?>

    </body>
</html>

