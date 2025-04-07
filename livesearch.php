<?php
include "connect.php";

// Search the product on the product table
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM product WHERE product_name LIKE '%$search%' OR description LIKE '%$search%'";
    $result = mysqli_query($con, $sql);
    $queryResult = mysqli_num_rows($result);
    if (!$queryResult) die("No products found");

    // Encode the results to json
    $json = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $json[] = $row;
    }
    echo json_encode($json);
    exit();
}
