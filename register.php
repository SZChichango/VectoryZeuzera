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
  <title>Create Account | Vectory Zeuzera</title>
</head>

<body>
  <div class="wrapper">
    <section class="container-flex">
      <h1>NEW CUSTOMER</h1>
      <h2>CREATE AN ACCOUNT</h2>

      <form method="post" action="add-user.php" autocomplete="on">
        <div class="input-align">
          <label for="first_name">First Name*:</label>
          <input type="text" name="first_name" id="first_name" required />
        </div>
        <div class="input-align">
          <label for="last_name">Last Name*:</label>
          <input type="text" name="last_name" id="last_name" required />
        </div>
        <div class="input-align">
          <label for="email">Email Address:</label>
          <input type="email" name="email" id="email" required />
        </div>

        <div class="input-align">
          <label for="phone">Phone Number:</label>
          <input type="tel" name="phone" id="phone_number" />
        </div>

        <div class="input-align">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" required />
        </div>
        <div class="input-align">
          <label for="dob">Date of Birth:</label>
          <input type="date" name="dob" id="dob" />
        </div>
        <button type="submit">SIGN UP</button>
        <p>Already have an account? <a href="login.php">Sign In</a> here</p>
      </form>
    </section>
  </div>
  <script src="script.js"></script>

</body>

</html>