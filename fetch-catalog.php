<?php

include "connect.php";



$sql = "SELECT product_id, product_name, image, price, category FROM product WHERE gender = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $_GET['gender']);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

// get the mysqli result


$data = array();
if ($result->num_rows > 0) {
    $sn = 1;
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
echo json_encode($data);
$con->close();
