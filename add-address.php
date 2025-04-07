<?php
include "connect.php";

// Retrieve user inputs

$userid = $_SESSION['user_id'];

if (!isset($_POST['name'], $_POST['address'], $_POST['country'], $_POST['city'], $_POST['state'],  $_POST['phone'])) {
    exit('Please complete the registration form!');
}

if (empty($_POST['name'] || $_POST['address'] || $_POST['country'] || $_POST['city'] || $_POST['state'] || $_POST['post_code'] || $_POST['phone'])) {
    exit('Please complete the registration form!');
}


if ($stmt = $con->prepare('INSERT INTO address (user_id, name, address, country, city, state, post_code, phone) VALUES (?, ?, ?, ? , ?, ?, ?, ?)')) {
    $stmt->bind_param('isssssss', $userid, $_POST['name'], $_POST['address'], $_POST['country'], $_POST['city'], $_POST['state'], $_POST['post_code'], $_POST['phone']);
    $stmt->execute();
    echo 'You have successfully Added the address!';
    header("location: dashboard.php");
} else {
    echo 'Could not prepare statement!';
}

$stmt->close();

$con->close();
