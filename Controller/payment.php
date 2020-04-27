
<?php
include "/opt/lampp/htdocs/sys11099/PHP/FurnitureStore"."/View/header.php";

?>
<!DOCTYPE html>
<html>

    <head>
        <title>Payment</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>

        <div class="payment_div">
            <p>Hi <?= isset($_SESSION["user"])?$_SESSION["user"]:"guest" ?>, please input your payment and delivery info</p>
            <form method='post' action='/sys11099/PHP/FurnitureStore/Controller/checkout.php'>
                <fieldset class="fieldset">
                    <legend>Payment Information</legend>
                    <input type='text' name='firstname_payment' placeholder='firstname'  ><br>
                    <input type='text' name='lastname_payment' placeholder='lastname'  ><br>
                    <input type='text' name='account_payment' placeholder='account number' ><br>       
                    <input type='text' name='expireddate_payment' placeholder='expired date(month/year): 01/22'  ><br>
                    <input type='text' name='securitycode_payment' placeholder='security code'  ><br>
                    <input type='text' name='address_payment' placeholder='Billing address 
                           (1000 queensway, ) ' ><br>       
                    <input type='text' name='city_payment' placeholder='city'  ><br>
                    <input type='text' name='country_payment' placeholder='country'  ><br>
                    <input type='text' name='postcode_payment' placeholder='post code'  ><br><br>

                </fieldset>

                <fieldset class="fieldset"> 
                    <legend>Delivery Information</legend>
                    <input type='text' name='firstname_delivery' placeholder='firstname'  ><br>
                    <input type='text' name='lastname_delivery' placeholder='lastname'  ><br>
                    <input type='text' name='phone_delivery' placeholder='phone number'  ><br>
                    <input type='email' name='email_delivery' placeholder='email'  ><br>
                    <input type='text' name='address_delivery' placeholder='Billing address 
                           (1000 queensway, ) ' ><br>       
                    <input type='text' name='city_delivery' placeholder='city'  ><br>
                    <input type='text' name='country_delivery' placeholder='country'  ><br>
                    <input type='text' name='postcode_delivery' placeholder='post code'  ><br><br>
                </fieldset>

                <input type='submit' value='Confirm' class="buy">

            </form>

        </div>
    </body>
</html>



