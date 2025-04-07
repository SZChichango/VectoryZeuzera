<?php
include "connect.php";

// Retrieve user inputs
echo $_POST['dob'];
if (!isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['dob'])) {
    exit('Please complete the registration form!');
}

if (empty($_POST['first_name'] || $_POST['last_name'] || $_POST['email'] || $_POST['password'] || $_POST['dob'])) {
    exit('Please complete the registration form!');
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    exit('Email is not valid!');
}

$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_DEFAULT);

if ($stmt = $con->prepare('SELECT user_id, password FROM user WHERE email = ?')) {
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'Email account is already registered to this website!';
    } else {
        if ($stmt = $con->prepare('INSERT INTO user (first_name, last_name, email, password, dob, role) VALUES (?, ?, ? , ?, ?, "customer")')) {
            $stmt->bind_param('sssss', $_POST['first_name'], $_POST['last_name'], $_POST['email'], $hash, $_POST['dob']);
            $stmt->execute();
            echo 'You have successfully registered!';
            header("location: login.php");
        } else {
            echo 'Could not prepare statement!';
            header("location: register.html");
        }
    }
    $stmt->close();
} else {
    echo 'Could not prepare statement!';
}
$con->close();
