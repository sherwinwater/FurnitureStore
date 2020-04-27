<?php
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/View/header.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/config/connect.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/Model/order.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/Model/billing.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/Model/delivery.php";

$today = date("Ymd");
$rand = strtoupper(substr(uniqid(sha1(time())), 0, 4));
$unique = $today . $rand;
$_SESSION['orderid'] = $unique;

$order = new Order($conn);
$billing = new Billing($conn);
$delivery = new Delivery($conn);
$_SESSION['user']=isset($_SESSION["user"])?$_SESSION["user"]:"guest";
    
foreach ($_SESSION['cart'] as $key => $value) {
    $params_order = array();
    array_push($params_order, 
            $value['productid'],
            $value['name'],
            $value['price'],
            $value['quantity'],
            $value['totalprice'],
            $value['imgpath'],
            $_SESSION['orderid'],
            $_SESSION['user'],
            $_SESSION['billing']['address_payment'], 
            $_SESSION['delivery']['address_delivery']
            );
    $order->insertOrder($params_order);
}

$params_billing = array();
foreach ($_SESSION['billing'] as $key => $value) {
    array_push($params_billing, $value);
}
array_push($params_billing, $_SESSION['user']);
$billing->insertBilling($params_billing);

$params_delivery = array();
foreach ($_SESSION['delivery'] as $key => $value) {
    array_push($params_delivery, $value);
}
array_push($params_delivery, $_SESSION['user']);
$delivery->insertDelivery($params_delivery);

?>

<!DOCTYPE html>

<html>
    <body>
        <p>Hi <?= isset($_SESSION["user"])?$_SESSION["user"]:"guest"?>, your order <?= $_SESSION['orderid'] ?> has been placed</p>

    </body>
</html>

