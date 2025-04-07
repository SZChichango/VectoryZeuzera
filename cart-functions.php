<?php
include "connect.php";

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = array();
}

// Update item quantity on the cart
if (isset($_POST['action'], $_POST['product_id'], $_POST['quantity']) && $_POST['action'] == "update") {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    foreach ($cart as $key => $product) {
        if ($product['product_id'] == $product_id) {
            $cart[$key]['quantity'] = $quantity;
            break;
        }
    }
    $_SESSION['cart'] = $cart;

    echo 1;
    exit();
}

if (isset($_POST['product_id'], $_POST['quantity'], $_POST['size'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];

    $product = array(
        'product_id' => $product_id,
        'quantity' => $quantity,
        'size' => $size
    );

    $cart[] = $product;

    $_SESSION['cart'] = $cart;


    exit();
}

// Update item quantity
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

// Check if the required POST variables are set, and the action is 'remove'
if (
    isset($_POST['product_id'], $_SESSION['cart'], $_POST['action']) &&
    is_numeric($_POST['product_id']) &&
    $_POST['action'] == 'remove'
) {
    $product_id = $_POST['product_id'];

    // Search for the product with the specified product_id in the cart
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['product_id'] == $product_id) {
            // Remove the product from the cart
            unset($_SESSION['cart'][$key]);
            echo 1;
            exit();
        }
    }
    // If we found a match, re-index the array so that there are no gaps.
    $_SESSION['cart'] = array_values($_SESSION['cart']);


    // Echo 0 to indicate that the specified product was not found in the cart
    echo 0;

    // Exit the script
    exit();
}

// Calculate the subtotal
function calculateSubtotal($cart, $con)
{
    $subtotal = 0;

    foreach ($cart as $product) {
        $product_id = $product['product_id'];
        $quantity = $product['quantity'];

        $stmt = $con->prepare("SELECT price FROM product WHERE product_id = ?");
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = mysqli_fetch_assoc($result)) {
            $price = $row['price'];
            $subtotal += $price * $quantity;
        }
    }

    return $subtotal;
}
