<?php
session_start();
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/View/header.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/config/connect.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/Model/product.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore" . "/Controller/cart/showCart.php";
showCart("hidden","");

//payment
$firstname_payment = filter_input(INPUT_POST, "firstname_payment", FILTER_SANITIZE_SPECIAL_CHARS);
$lastname_payment  = filter_input(INPUT_POST, "lastname_payment", FILTER_SANITIZE_SPECIAL_CHARS);
$account_payment  = filter_input(INPUT_POST, "account_payment", FILTER_SANITIZE_SPECIAL_CHARS);
$expireddate_payment  = filter_input(INPUT_POST, "expireddate_payment", FILTER_SANITIZE_SPECIAL_CHARS);
$securitycode_payment  = filter_input(INPUT_POST, "securitycode_payment", FILTER_SANITIZE_SPECIAL_CHARS);
$address_payment  = filter_input(INPUT_POST, "address_payment", FILTER_SANITIZE_SPECIAL_CHARS);
$city_payment  = filter_input(INPUT_POST, "city_payment", FILTER_SANITIZE_SPECIAL_CHARS);
$country_payment  = filter_input(INPUT_POST, "country_payment", FILTER_SANITIZE_SPECIAL_CHARS);
$postcode_payment  = filter_input(INPUT_POST, "postcode_payment", FILTER_SANITIZE_SPECIAL_CHARS);

$_SESSION['billing']['firstname_payment'] = $firstname_payment ;
$_SESSION['billing']['lastname_payment'] = $lastname_payment ;
$_SESSION['billing']['account_payment'] = $account_payment ;
$_SESSION['billing']['expireddate_payment'] = $expireddate_payment ;
$_SESSION['billing']['securitycode_payment'] = $securitycode_payment ;
$_SESSION['billing']['address_payment'] = $address_payment ;
$_SESSION['billing']['city_payment'] = $city_payment ;
$_SESSION['billing']['country_payment'] = $country_payment ;
$_SESSION['billing']['postcode_payment'] = $postcode_payment ;

//delivery
$firstname_delivery = filter_input(INPUT_POST, "firstname_delivery", FILTER_SANITIZE_SPECIAL_CHARS);
$lastname_delivery = filter_input(INPUT_POST, "lastname_delivery", FILTER_SANITIZE_SPECIAL_CHARS);
$phone_delivery = filter_input(INPUT_POST, "phone_delivery", FILTER_SANITIZE_SPECIAL_CHARS);
$email_delivery = filter_input(INPUT_POST, "email_delivery", FILTER_SANITIZE_SPECIAL_CHARS);
$address_delivery = filter_input(INPUT_POST, "address_delivery", FILTER_SANITIZE_SPECIAL_CHARS);
$city_delivery = filter_input(INPUT_POST, "city_delivery", FILTER_SANITIZE_SPECIAL_CHARS);
$country_delivery = filter_input(INPUT_POST, "country_delivery", FILTER_SANITIZE_SPECIAL_CHARS);
$postcode_delivery = filter_input(INPUT_POST, "postcode_delivery", FILTER_SANITIZE_SPECIAL_CHARS);

$_SESSION['delivery']['firstname_delivery'] = $firstname_delivery;
$_SESSION['delivery']['lastname_delivery'] = $lastname_delivery;
$_SESSION['delivery']['phone_delivery'] = $phone_delivery;
$_SESSION['delivery']['email_delivery'] = $email_delivery;
$_SESSION['delivery']['address_delivery'] = $address_delivery;
$_SESSION['delivery']['city_delivery'] = $city_delivery;
$_SESSION['delivery']['country_delivery'] = $country_delivery;
$_SESSION['delivery']['postcode_delivery'] = $postcode_delivery;

?>

<!DOCTYPE html>
<html>

    <head>
        <title>checkout</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <h2>Hi <?= isset($_SESSION["user"])?$_SESSION["user"]:"guest" ?>, Your Order Info</h2>
        <h3>Order Information</h3>
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
        <div class="order_billinginfo">
            <p>Name:<a><?= $_SESSION['billing']['firstname_payment'] . " " . $_SESSION['billing']['lastname_payment'] ?></a></p>
            <p>Billing address:<a><?=
                    $_SESSION['billing']['address_payment'] . "," . $_SESSION['billing']['city_payment']
                    . "," . $_SESSION['billing']['country_payment'] . "," . $_SESSION['billing']['postcode_payment']
                    ?></a></p>
        </div>
    </div>
    <a href="/sys11099/PHP/FurnitureStore/Controller/placeOrder.php" class="buy">Place Order</a>
</body>
</html>