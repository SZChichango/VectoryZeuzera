<?php
include "connect.php";

// Check if the required POST variables are set
if (isset($_POST['product_id'], $_POST['quantity'], $_POST['size'])) {
    // Extract the product_id, quantity, and size from the POST data
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];

    // Check if a cart session variable exists
    if (isset($_SESSION['cart'])) {
        // If it exists, assign its value to the $cart variable
        $cart = $_SESSION['cart'];

        // Check if the product with the same product ID and size is already in the cart
        $existingProductKey = false;
        foreach ($cart as $key => $product) {
            if ($product['product_id'] == $product_id && $product['size'] == $size) {
                $existingProductKey = $key;
                break;
            }
        }

        if ($existingProductKey !== false) {


            echo 2;

            exit();
        } else {
            // If the product doesn't exist, create an array representing the product with its details
            $product = array(
                'product_id' => $product_id,
                'quantity' => $quantity,
                'size' => $size
            );

            // Add the current product to the cart array
            $cart[] = $product;
        }
    } else {
        // If the cart session variable doesn't exist, initialize an empty array for the $cart variable
        $cart = array();

        // Create an array representing the product with its details
        $product = array(
            'product_id' => $product_id,
            'quantity' => $quantity,
            'size' => $size
        );

        // Add the current product to the cart array
        $cart[] = $product;
    }

    // Update the cart session variable with the modified cart array
    $_SESSION['cart'] = $cart;

    // Echo 1 to indicate successful addition to the cart
    echo 1;

    // Exit the script
    exit();
} else {
    // If the required POST variables are not set, echo 0
    echo 0;
}
