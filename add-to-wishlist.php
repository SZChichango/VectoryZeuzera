<?php
session_start();
include "connect.php";

if (!isset($_SESSION['loggedin'])) {
    # code...
    header("location: login.php");
    exit;
}

// add product to wishlist database table
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $con->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)");
    $stmt->bind_param('ii', $user_id, $product_id);

    if ($stmt->execute()) {

        header('location: wishlist.php');
        exit;
    } else {
        die('Error while adding to wishlist');
    }

    // header('location: wishlist.php');
    exit;
} else {
    die('Invalid product ID');
}
