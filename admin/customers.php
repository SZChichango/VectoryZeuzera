<?php
include "../connect.php";

if (!isset($_SESSION["loggedin"])) {
  header("Location: admin-login.php");
  exit();
}

// Fetch users form the user table
$stmt = $con->prepare("SELECT * FROM user WHERE role = 'customer'");
$stmt->execute();
$result = $stmt->get_result();

// Delete user
echo $_POST['delete'];
if (isset($_POST['delete'])) {
  echo "Running";
  $user_id = $_POST['user_id'];
  $sqlAdd = "DELETE FROM address WHERE user_id = $user_id";
  if ($result = mysqli_query($con, $sqlAdd)) {
    echo "Running";
    $sql = "DELETE FROM user WHERE user_id = $user_id";
    $resultUser = mysqli_query($con, $sql);
    $sql = "DELETE FROM wishlist WHERE user_id = $user_id";
    $resultWishlist = mysqli_query($con, $sql);
  } else {
    echo "Error deleting record: " . mysqli_error($con);
  }

  header('Location: customers.php');
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
  <title>CMS | Vectory Zeuzera</title>
</head>

<body>
  <div class="wrapper">
    <?php include_once "header.php" ?>
    <div class="main">
      <div class="page-title">
        <h1>Products</h1>

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
              <th>
                <input type="checkbox" name="select-all" id="" onclick="checkAll(this)" />
              </th>
              <th>ID</th>
              <th>Name</th>
              <th>E-mail</th>
              <th>Phone</th>
              <th>Gender</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              $sn = 1;
              while ($row = $result->fetch_assoc()) {

            ?>
                <tr>
                  <td><input type="checkbox" name="select" id="" /></td>
                  <td><?php echo $row['user_id']; ?></td>
                  <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['cellphone_number']; ?></td>
                  <td>Active</td>
                  <td><span class="status">active</span></td>
                  <td>
                    <form action="" method="post">
                      <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                      <button type="submit" name="delete" class="delete">Delete</button>
                    </form>

                  </td>
                </tr>
            <?php
                $sn++;
              }
            } else {
              echo "<tr><td colspan='8' class='text-center'>No Products Found</td></tr>";
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