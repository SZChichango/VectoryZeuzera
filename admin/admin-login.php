<?php
// Compare this snippet from admin/customers.php
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="../login.css" />
  <title>Admin Login | Vectory Zeuzera</title>
</head>

<body>
  <div class="wrapper">


    <section class="container-flex">
      <h1>SIGN IN</h1>

      <form action="authenticate.php" method="post">
        <div class="input-align">
          <label for="email">Email Address:</label>
          <input type="email" name="email" required />
        </div>
        <div class="input-align">
          <label for="password">Password:</label>
          <input type="password" name="password" required />
        </div>

        <button type="submit">SIGN IN</button>

        <p>Forgot your password? <a href="#">Contact Webmaster</a>!</p>

      </form>
    </section>

  </div>

</body>

</html>