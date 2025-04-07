<?php
include_once "../connect.php";

if (!isset($_SESSION["loggedin"])) {
  header("Location: admin-login.php");
  exit();
}

// Total number of customers
$stmt = $con->prepare("SELECT COUNT(user_id) FROM user WHERE role = 'customer'");
$stmt->execute();
$result = $stmt->get_result();
$totalCustomers = $result->fetch_row()[0];

// Total number of orders
$stmt = $con->prepare("SELECT COUNT(order_id) FROM `order`");
$stmt->execute();
$result = $stmt->get_result();
$totalOrders = $result->fetch_row()[0];

// Total number of products
$stmt = $con->prepare("SELECT COUNT(product_id) FROM product");
$stmt->execute();
$result = $stmt->get_result();
$totalProducts = $result->fetch_row()[0];

// Total profit
$stmt = $con->prepare("SELECT SUM(order_amount) FROM `order`");
$stmt->execute();
$result = $stmt->get_result();
$totalProfit = $result->fetch_row()[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="admin.css" />
  <title>Dashboard</title>
</head>

<body>
  <div class="wrapper">
    <?php include_once "header.php" ?>
    <section id="dashboard">
      <h1>Dashboard</h1>
      <div class="dashboard-stats">
        <div class="total-customers bx-grid">
          <h4>TOTAL CUSTOMERS</h4>
          <span class="tc"><?php echo $totalCustomers; ?></span>
        </div>
        <div class="total-orders bx-grid">
          <h4>TOTAL ORDERS</h4>
          <span class="tc"><?php echo $totalOrders; ?></span>
        </div>
        <div class="total-sales bx-grid">
          <h4>TOTAL Products</h4>
          <span class="tc"><?php echo $totalProducts; ?></span>
        </div>
        <div class="avg-order-sale bx-grid">
          <h4>Total Revenue</h4>
          <span class="tc">R<?php echo $totalProfit; ?></span>
        </div>
      </div>
      <div class="sale-stock__grid">
        <div class="sale-stock__item">
          <h4>TOP SELLING PRODUCTS</h4>
          <div class="product bx-flex">
            <p class="product-name">Lorem Ipsum</p>
            <span class="sales-total">0</span>
          </div>
          <div class="product bx-flex">
            <p class="product-name">Lorem Ipsum</p>
            <span class="sales-total">0</span>
          </div>
        </div>
        <div class="sale-stock__item">
          <h4>STOCK THRESHOLD</h4>
          <div class="bx-flex">
            <p class="customer-name">Lorem ipsum dolor</p>
            <span class="stock-left">0</span>
          </div>
          <div class="bx-flex">
            <p class="customer-name">Lorem ipsum dolor</p>
            <span class="stock-left">0</span>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>

</html>