<?php
include "connect.php";
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
  <title>Vectory Zeuzera</title>
</head>

<body>
  <div class="wrapper">
    <?php include_once "header.php"; ?>


    <section class="hero">
      <img src="VZ/205032577_199438335405950_3357863180958329937_n.jpg" alt="" />
      <div class="text-overlay">
        <h1 class="text-title">Welcome to Vectory Zeuzera, your streetwear apparel store </h1>
        <p class="text-slogan">Shop now and make a bold statement with your streetwear style!</p>
        <a href="#shop" class="btn">Shop Now</a>
      </div>
    </section>

    <section id="shop" class="collections">
      <h2 class="section-title">Shop By</h2>
      <div class="cards">
        <div class="card" onclick="window.location.href='catalog.php?gender=Male';">
          <img src="VZ/81276872_222206028790379_5471685013113448924_n.jpg" alt="item" />
          <p class="product-name">MEN</p>
        </div>
        <div class="card" onclick="window.location.href='catalog.php?gender=Male';">
          <img src="VZ/209407712_454733505715757_1027917535433160287_n.jpg" alt="item" />
          <p class="product-name">WOMEN</p>
        </div>

    </section>

    <section class="about">
      <img src="VZ/55890570_2253831324885738_1686651487064636533_n.jpg" alt="item" />
      <p>
        Welcome to Vectory Zeuzera, South Africa's premier streetwear clothing brand. Since 2017, we have been delivering innovative and stylish designs that capture the essence of urban fashion. Our e-commerce website is your gateway to our exclusive collections, allowing you to explore, shop, and express your individuality with ease. From trendy t-shirts and hoodies to statement accessories, we have something for everyone. With secure transactions, efficient shipping, and a dedicated customer support team, your satisfaction is our priority. Join us on this fashion-forward journey and experience the cutting-edge world of Vectory Zeuzera.
      </p>
    </section>
    <?php include_once "footer.php"; ?>

    <script src="script.js"></script>
</body>

</html>