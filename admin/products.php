<?php
include "../connect.php";



//Fetch data from the database
$sql = 'SELECT product_id, product_name, category, price, gender FROM product';
$result = mysqli_query($con, $sql);
// get the mysqli result

$data = array();

// Calculate the total qauntity of a product
function calculateTotalQuantity($product_id)
{
  global $con;
  $sql = "SELECT SUM(quantity) AS total_quantity FROM quantities WHERE product_id = $product_id";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['total_quantity'];
}

// Delete product from table and database
if (isset($_GET['delete'])) {
  $product_id = $_GET['delete'];
  $sql = "DELETE FROM product WHERE product_id = $product_id";
  $result = mysqli_query($con, $sql);
  $sql = "DELETE FROM quantities WHERE product_id = $product_id";
  $result = mysqli_query($con, $sql);
  header('Location: products.php');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="table.css" />
  <title>Products</title>
</head>

<body>
  <div class="wrapper">
    <?php include_once "header.php" ?>
    <div class="main">
      <div class="page-title">
        <h1>Products</h1>

        <a href="product.php">Add Product</a>



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
            <option value="product-category">Category</option>
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
              <th>
                <input type="checkbox" name="select-all" id="" onclick="checkAll(this)" />
              </th>
              <th>ID</th>
              <th>Product Name</th>
              <th>Category</th>
              <th>Type</th>
              <th>Status</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="products-data">
            <?php
            if ($result->num_rows > 0) {
              $sn = 1;
              while ($row = $result->fetch_assoc()) {

            ?>

                <tr>
                  <td><input type="checkbox" name="select" id="" /></td>
                  <td><?php echo $row['product_id']; ?></td>
                  <td><?php echo $row['product_name']; ?></td>
                  <td><?php echo $row['category']; ?></td>
                  <td><?php echo $row['gender']; ?></td>
                  <td>
                    <span class="status">Active</span>
                  </td>
                  <td><?php echo $row['price']; ?></td>
                  <td><?php echo calculateTotalQuantity($row['product_id']); ?></td>
                  <td class="action">
                    <form action="product.php" method="post">
                      <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                      <input type="submit" name="edit" value="Edit">
                    </form>
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <a href="products.php?delete=<?php echo $row['product_id']; ?>" class="delete">Delete</a>

                  </td>
                </tr>
            <?php
              }
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