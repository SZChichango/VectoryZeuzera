<?php
include "connect.php";

$query = 'SELECT first_name, last_name, email FROM user where email = ?';
$stmt = $con->prepare($query);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result

if ($conn->query($sql)) {
    echo "value inserted";
} else {
    echo "insertion failed";
}
$conn->close();
