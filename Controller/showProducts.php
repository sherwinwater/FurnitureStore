<?php
if (!isset($_SESSION)) {
    session_start();
}
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore" . "/View/header.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore" . "/config/connect.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore" . "/Model/product.php";

// read all products in the database
$product = new Product($conn);
$columnNames = $product->getColumnNames();
$productList = $product->gerAllProducts();

//add to cart
$productid = isset($_GET['id']) ? $_GET['id'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 0;
$price = isset($_GET['price']) ? $_GET['price'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$imgpath = isset($_GET['imgpath']) ? $_GET['imgpath'] : "";

if ($quantity != 0) {
    $product_to_cart = array(
        "productid" => $productid,
        "name" => $name,
        "price" => $price,
        "quantity" => $quantity,
        "totalprice" => $quantity * $price,
        "imgpath" => $imgpath);
    $_SESSION['cart'][$productid] = $product_to_cart;
}

?>

<!DOCTYPE html>
<html>
    <body>
        <div class="container-flex">
            <?php
            foreach ($productList as $key => $value) {
                echo "<div class='product_div'>";
                echo "<form method='get' action='/sys11099/PHP/FurnitureStore/Controller/showProducts.php'>";
                echo "<img src='" . $value['imgpath'] . "' alt=" . $value['name'] . " "
                . "style='width:100px;heigth:100px;'><br>";
                echo "<p>" . $value['productid'] . "</p>";
                echo "<p>" . $value['name'] . "</p>";
                echo "<p>$" . $value['price'] . "</p>";
                echo "<input type='text' name='imgpath' value=" . $value['imgpath'] . " hidden><br>";
                echo "<input type='text' name='name' value=" . $value['name'] . " hidden><br>";
                echo "<input type='text' name='price' value=" . $value['price'] . " hidden><br>";
                echo "<input type='number' name='id' value=" . $value['productid'] . " hidden><br>";
                echo "Quantity: <input type='number' name='quantity' min='0' required><br>";
                echo "<input type='submit' value='Add to cart'><br>";
                echo "</form>";
                echo "</div>";
            }
            ?>    
        </div>
        <br>
        <a  href="/sys11099/PHP/FurnitureStore/Controller/cart/cart.php" class="add checkout buy"> Proceed to Checkout</a><br>
        <script>

        </script>
    </body>
</html>

