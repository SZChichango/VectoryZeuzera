<?php
include "connect.php";

$cart = $_POST['cart'];
// update item quantity value on cart
if (isset($_POST['product_id'], $_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    foreach ($cart as $key => $product) {
        if ($product['product_id'] == $product_id) {
            $cart[$key]['quantity'] = $quantity;
            break;
        }
    }

    $_SESSION['cart'] = $cart;

    exit();
}
