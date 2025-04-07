<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../connect.php";

// Check if product already exists, if it exists update, if not add product
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    $sql = "UPDATE product SET product_name = '$product_name', category = '$category', price = '$price' WHERE product_id = $product_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "Product updated successfully";
    } else {
        echo "Error updating product: " . mysqli_error($con);
    }
} else {
    if (!isset($_POST['product_name'], $_POST['category_name'], $_POST['gender'], $_POST['price'], $_POST['image'], $_POST["quantities"])) {
        exit('Please complete the product for!');
    }

    if (empty($_POST['product_name'] || $_POST['category_name'] || $_POST['gender'] || $_POST['description'] || $_POST['price'] || $_POST['image'] || $_POST["quantities"])) {
        exit('Please complete the product form! 0');
    }


    $stmt = $con->prepare('INSERT INTO product (product_name, image, category, description, price, gender) VALUES (?, ?, ?, ?, ?, ?)');
    //
    $stmt->bind_param('ssssds', $_POST['product_name'], $_POST['image'], $_POST['category_name'], $_POST['description'], $_POST['price'], $_POST['gender']);
    $stmt->execute();
    $product_id = $stmt->insert_id;
    $stmt->close();

    // Insert sizes and quantities into the 'quantities' table
    $quantityStmt = $con->prepare('INSERT INTO quantities (product_id, size_id, quantity) VALUES (?, ?, ?)');

    $quantities = $_POST['quantities'];
    $sizes = $_POST["sizes"];

    foreach ($sizes as $index => $size) {
        # code...
        $sizeId = $index + 1;
        $quantity = $quantities[$index];

        $quantityStmt->bind_param('iii', $product_id, $sizeId, $quantity);
        $quantityStmt->execute();
    }

    $quantityStmt->close();
    $con->close();

    header('Location: products.php');
}
