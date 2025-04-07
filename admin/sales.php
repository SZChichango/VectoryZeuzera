<?php
include "../connect.php";

if (!isset($_SESSION["loggedin"])) {
  header("Location: admin-login.php");
  exit();
}

// Fetch all the orders on the orders table
$stmt = $con->prepare("SELECT * FROM `order`");
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="table.css" />
  <title>Sales</title>
</head>

<body>
  <div class="wrapper">
    <?php include_once "header.php" ?>
    <div class="main">
      <div class="page-title">
        <h1>Orders</h1>

      </div>
      <div class="filter">
        <div class="filter-item">
          <input type="text" name="search" id="search-products" />
          <button>Search</button>
        </div>
        <div class="filter-item">
          <label for="items-per-page">Items Per Page</label>
          <select name="items-per-page" id="">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
          </select>
          <select name="filter" id="">
            <option value="">Filter</option>
            <option value="id">ID</option>
            <option value="sku">SKU</option>
            <option value="product-name">Name</option>
            <option value="product-number">Product Number</option>
            <option value="type">Type</option>
            <option value="price">Price</option>
            <option value="status">Status</option>
          </select>
        </div>
        <p class="result-count"><span>0</span> result(s) found</p>
      </div>
      <div class="products-table">
        <table class="products">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Order</th>
              <th>Address</th>
              <th>Phone Number</th>
              <th>Subtotal</th>
              <th>Grand Total</th>
              <th>Order Date</th>

            </tr>
          </thead>
          <tbody>

            <?php
            if ($result->num_rows > 0) {
              $sn = 1;
              while ($row = $result->fetch_assoc()) {

            ?>
                <tr>
                  <td><?php echo $row['order_id']; ?></td>
                  <td><?php echo $row['name'] ?></td>
                  <td>2 x Sunset Citrus Hoodie</td>
                  <td><?php echo $row['address']; ?></td>
                  <td><?php echo $row['phone']; ?></td>
                  <td>$<span class="sub-total"><?php echo $row['order_amount'] - 100; ?></span></td>
                  <td>$<span class="grand-total"><?php echo $row['order_amount']; ?></span></td>
                  <td class="date"><?php echo $row['order_date']; ?></td>
                </tr>
              <?php
                $sn++;
              }
            } else {
              ?>
              <tr>
                <td colspan="7" class="no-result">No results found</td>
              </tr>
            <?php
            }
            ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="table.js"></script>
</body>

</html>