<?php
include "../connect.php";

// Calculate the total qauntity of a product
function calculateTotalQuantity($product_id)
{
    global $con;
    $sql = "SELECT SUM(quantity) AS total_quantity FROM quantities WHERE product_id = $product_id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total_quantity'];
}

//Fetch data from the database
$sql = 'SELECT product.product_id, product.product_name, product.category, product.price, product.gender FROM product';
$result = mysqli_query($con, $sql);
// get the mysqli result

$data = array();
if ($result->num_rows > 0) {
    $sn = 1;
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
$con->close();



echo json_encode($data);
