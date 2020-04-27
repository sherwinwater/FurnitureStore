<?php

$totalprice =$cart_table = "";

function showCart($a, $b) {
    global $totalprice,$cart_table;

    if (isset($_SESSION['cart'])) {
        $cart_table .= "<table id='tableItems'>";
        $cart_table .= "<tr>"
                . "<th>ID</th>"
                . "<th>Productid</th>"
                . "<th>Product</th>"
                . "<th>Unit Price</th>"
                . "<th>Quantity</th>"
                . "<th>Total Price</th>"
                . "</tr>";
        $i = 0;
        $totalprice = 0;

        foreach ($_SESSION['cart'] as $key => $value) {

            $cart_table .= "<tr id='row" . $i . "'>"
                    . "<td>" . ($i + 1) . "</td>"
                    . "<td>" . $value["productid"] . "</td>"
                    . "<td>" . "<img src=" . $value["imgpath"] . "><br>" . $value["name"] . "</td>"
                    . "<td id='unitprice" . $i . "'>" . $value["price"] . "</td>"
                    . '<td ' . $a . '><input type="number" class="quantity" name="quantity' . $i . '" min="0" value="' . $value["quantity"] . '" required><br>'
                    . '<button class="deleteBtn" type="button">delete</button>' . "</td>"
                    . "<td " . $b . " >" . $value["quantity"] . "</td>"
                    . "<td id='price" . $i . "'>" . $value["quantity"] * $value["price"] . "</td>"
                    . '<input type="text" name="id' . $i . '" value="' . $value["productid"] . '" hidden><br>'
                    . "</tr>";
            $i++;
            $totalprice += $value["quantity"] * $value["price"];
        }

        $_SESSION['totalprice'] = $totalprice;
        $cart_table .= "<tr>"
                . "<td colspan='5'>" . "Sum" . "</td>"
                . "<td id='totalprice'>" . $totalprice . "</td>"
                . "</tr>";
        $cart_table .= "</table><br>";
    }
}

?>