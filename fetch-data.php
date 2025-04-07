<?php
include "connect.php";

//Fetch data from the database
$sql = 'SELECT user.first_name, user.last_name, user.email, user.cellphone_number, user.dob FROM user WHERE user_id = ?';
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
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
