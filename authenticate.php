<?php
include "connect.php";

if (!isset($_POST['email'], $_POST['password'])) {
    // Could not get the data that should have been sent.
    exit('Please fill both the username and password fields!');
}

if ($stmt = $con->prepare('SELECT user_id, password FROM user WHERE email = ?')) {

    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    // Store the result
    $stmt->store_result();
    if (count($_POST) > 0) {
        $stmt->bind_result($user_id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Password verification
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has logged-in!
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['user_id'] = $user_id;
            $_SESSION['loggedin'] = true;
            header("location: index.php");
        } else {
            // Send an alert to the login.php page
            header("location:login.php?loginFailed=true");
        }
    } else {
        // Incorrect username
        echo 'Incorrect username and/or password!';
        //        header("location: login.php");
    }

    $stmt->close();
}
