<?php
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/config/connect.php";
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/Model/product.php";

$product = new Product($conn);
//load products
$params = Array();
$params[0] = Array(12389, "Borquez_Barrel_Chair", "Borquez_Barrel_Chair", 4.00,"/sys11099/PHP/FurnitureStore/Model/img/Borquez_Barrel_Chair.jpg");
$params[1] = Array(43379, "Chicopee_6_Drawer_Double_Dresser", "Chicopee_6_Drawer_Double_Dresser", 10.4,"/sys11099/PHP/FurnitureStore/Model/img/Chicopee_6_Drawer_Double_Dresser.jpg");
$params[2] = Array(25469, "Halstead_Hall_Tree_with_Bench_and_Shoe_Storage", "Halstead_Hall_Tree_with_Bench_and_Shoe_Storage", 20.4,"/sys11099/PHP/FurnitureStore/Model/img/Halstead_Hall_Tree_with_Bench_and_Shoe_Storage.jpg");
$params[3] = Array(26459, "Jolie_Chaise_Lounge", "Jolie_Chaise_Lounge", 20.4,"/sys11099/PHP/FurnitureStore/Model/img/Jolie_Chaise_Lounge.jpg");

foreach ($params as $value) {
    $product->loadProduct($value);
}
