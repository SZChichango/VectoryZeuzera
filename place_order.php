<?php
include "connect.php";

function clearCart()
{
    unset($_SESSION['cart']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $total = $_POST['order_total'];
    $user_id = $_SESSION['user_id'];

    echo $total, $user_id;
    // store order details in the order table
    if ($stmt = $con->prepare('INSERT INTO `order` (user_id, name, order_amount, address, zip_code, items_count) VALUES (?, ?, ?, ?, ?, ?)')) {
        # code...
        $stmt->bind_param('isdssi', $user_id, $_POST['name'], $total, $_POST['address'], $_POST['zip'], $_POST['order-items']);
        $stmt->execute();
        $stmt->close();

        clearCart();
    } else {
        # code...
        echo "Error: " . $con->error;
    }


    $con->close();
    // Display a confirmation message
    header('location: success.html');
    exit();
}

clearCart();
