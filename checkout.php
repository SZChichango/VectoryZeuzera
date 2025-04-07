<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "connect.php";

if (isset($_POST['subtotal'])) {
    $subtotal = $_POST['subtotal'];
} else {
    $subtotal = 0;
}

$shippingFee = 100;



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-KEZQDW1YNB"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-KEZQDW1YNB');
    </script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" />

    <title>Checkout | Vectory Zeuzera</title>
</head>

<body>
    <div class="wrapper">
        <?php include_once "header.php"; ?>
        <h1 class="checkout-title">Checkout</h1>
        <div class="checkout-form">
            <form action="place_order.php" method="post" id="checkout-form">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" required></textarea>
                </div>
                <div class="form-group">
                    <label for="zip">Zip Code:</label>
                    <input type="text" id="zip" name="zip" required>
                </div>
                <div class="form-group">
                    <label for="card-number">Credit Card Number:</label>
                    <input type="text" id="card-number" name="card-number" required>
                </div>
                <div class="form-group">
                    <label for="expiry-date">Expiry Date (MM/YY):</label>
                    <input type="text" id="expiry-date" name="expiry-date" required>
                    <span id="expiry-error" class="error"></span>
                </div>
                <input type="submit" value="Place Order">
                <p class="total">Total: R<?php echo $subtotal + $shippingFee; ?></p>
                <input type="hidden" name="order_total" value="<?php echo $subtotal + $shippingFee; ?>">
                <input type="hidden" name="order-items" value="<?php echo count($_SESSION['cart']); ?>)">
            </form>
        </div>
        <script>

        </script>
        <?php include_once "footer.php"; ?>
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=AWXfiqfjbxhZwfpO6FrIJIXHE3aEJ2Smqdd68mmWLKPXvHWDxGD6tfaIyUW65XqS01rrsNmYtlCyRq9f"></script>
    <script>
        let orderTotal = document.querySelector("input[name=order_total]");

        paypal.Buttons({
            createOrder: function(data, actions) {
                // Set up the transaction details
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: orderTotal.value // Set the amount
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Capture the funds from the transaction
                return actions.order.capture().then(function(details) {
                    // Clear cart and go to success.html
                    fetch("place_order.php", {
                        method: "POST",
                        body: new URLSearchParams(new FormData(document.getElementById("checkout-form")))
                    }).then(function(response) {
                        return response.text();
                    }).then(function(text) {
                        console.log(text);
                        window.location.href = "success.html";
                    });


                });
            }
        }).render('#checkout-form');
    </script>
    <script src="script.js"></script>
    <script src="creditcardchecker.js"></script>
</body>

</html>