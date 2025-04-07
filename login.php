<?php
include "connect.php";

if (isset($_GET['loginFailed'])) {

  echo "<script>alert('Incorrect username and/or password!')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-KEZQDW1YNB"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-KEZQDW1YNB');
  </script>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="login.css" />
  <title>Account | Vectory Zeuzera</title>
</head>

<body>
  <div class="wrapper">
    <?php include_once "header.php"; ?>

    <section class="container-flex">
      <h1>SIGN IN</h1>
      <h2>EXISTING CUSTOMER</h2>
      <form action="authenticate.php" method="post" id="form">
        <div class="input-align">
          <label for="email">Email Address:</label>
          <input type="email" name="email" id="email" required />
        </div>
        <div class="input-align">
          <label for="password">Password:</label>
          <input type="password" name="password" id="passsword" required />
        </div>

        <button type="submit">SIGN IN</button>
        <p>Do not have an account? <a href="register.php">Sign Up</a> here</p>
        <p>Admin Login <a href="./admin/admin-login.php">Login Page</a>!</p>

      </form>
    </section>
    <?php include_once "footer.php"; ?>
  </div>
  <script src="script.js"></script>
</body>

</html>