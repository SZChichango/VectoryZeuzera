<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../connect.php";
// Edit product information

if (isset($_POST['Edit'])) {
  $product_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $category = $_POST['category'];
  $price = $_POST['price'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="product.css" />
  <title>Edit Product</title>
</head>

<body>
  <?php include_once "header.php" ?>
  <div class="main">
    <form action="add-product.php" method="post">
      <div class="page-title">
        <h1>Product</h1>
        <button type="submit" class="add-product">Save Product</button>
      </div>
      <div class="product-form">
        <?php
        if (isset($_POST['product_id'])) {
          $product_id = $_POST['product_id'];
          $sql = "SELECT * FROM product WHERE product_id = $product_id";
          $result = mysqli_query($con, $sql);
          $row = mysqli_fetch_assoc($result);

        ?>
          <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">

          <div class="form-item">
            <label for="product_name">Name*</label>
            <input name="product_name" id="name" placeholder="Name" value="<?php echo $row['product_name'] ?>" />
          </div>
          <div class="form-item">
            <label for="category">Category*</label>
            <select name="category" id="category">
              <option value="">--Select--</option>
              <option value="Tops" <?php if ($row['category'] == 'Tops') echo 'selected' ?>>Tops</option>
              <option value="T-Shirt" <?php if ($row['category'] == 'T-Shirt') echo 'selected' ?>>T-Shirt</option>
              <option value="Hoodie" <?php if ($row['category'] == 'Hoodie') echo 'selected' ?>>Hoodie</option>
              <option value="Sweatshirt" <?php if ($row['category'] == 'Sweatshirt') echo 'selected' ?>>Sweatshirt</option>
              <option value="Hats" <?php if ($row['category'] == 'Hats') echo 'selected' ?>>Hats</option>
            </select>
          </div>

          <div class="form-item">
            <label for="sizes">Sizes and Quantities:</label>
            <div class="inline">
              <input type="checkbox" id="size-s" name="sizes[]" value="S">
              <label for="size-s">S</label>
              <input type="number" id="quantity-s" name="quantities[]" placeholder="quantity" required>
            </div>
            <div class="inline">
              <input type="checkbox" id="size-m" name="sizes[]" value="M">
              <label for="size-m">M</label>
              <input type="number" id="quantity-m" name="quantities[]" placeholder="quantity" required>
            </div>
            <div class="inline">
              <input type="checkbox" id="size-l" name="sizes[]" value="L">
              <label for="size-l">L</label>
              <input type="number" id="quantity-l" name="quantities[]" placeholder="quantity" required>
            </div>
            <div class="inline">
              <input type="checkbox" id="size-xl" name="sizes[]" value="XL">
              <label for="size-xl">XL</label>
              <input type="number" id="quantity-xl" name="quantities[]" placeholder="quantity" required>
            </div>
          </div>
      </div>

      <div class="form-item">
        <label for="gender">Gender</label>
        <select name="gender" id="">
          <option value="">--Select--</option>
          <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected' ?>>Male</option>
          <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected' ?>>Femaale</option>
          <option value="Other" <?php if ($row['gender'] == 'Other') echo 'selected' ?>>Other</option>
        </select>
      </div>
      <div class="form-item">
        <label for="description">Description*</label>
        <textarea type="text" id="description" placeholder="Description" name="description value=" <?php echo $row['description']; ?>"></textarea>
      </div>
      <div class="form-item">
        <label for="price">Price*</label>
        <input name="price" type="number" id="price" placeholder="Price" min="0" step="0.01" value="<?php echo $row['price']; ?>" />
      </div>
      <div class="form-item">
        <label for="image">Select image:</label>
        <input type="file" name="image" accept="image/*" />
      </div>
      <div class="form-item">
        <label for="display-item">Display Item</label>
        <select name="display-item" id="">
          <option value="yes">Yes</option>
          <option value="no">No</option>
        </select>
      </div>
    <?php
        } else {
          echo "it is the else :("
    ?>
      <div class="form-item">
        <label for="product_name">Name*</label>
        <input name="product_name" id="name" placeholder="Name" />
      </div>
      <div class="form-item">
        <label for="category_name">Category</label>
        <select name="category_name" id="">
          <option value="">--Select--</option>
          <option value="Tops">Blouse</option>
          <option value="T-Shirt">T-Shirt</option>
          <option value="Jacket">Jacket</option>
          <option value="Hoodie">Hoodie</option>
          <option value="Sweatshirt">Sweatshirt</option>
          <option value="Hats">Hat</option>
        </select>

        <div class="form-item">
          <label for="sizes">Sizes and Quantities:</label>
          <div class="inline">
            <input type="checkbox" id="size-s" name="sizes[]" value="S">
            <label for="size-s">S</label>
            <input type="number" id="quantity-s" name="quantities[]" placeholder="quantity" required>
          </div>
          <div class="inline">
            <input type="checkbox" id="size-m" name="sizes[]" value="M">
            <label for="size-m">M</label>
            <input type="number" id="quantity-m" name="quantities[]" placeholder="quantity" required>
          </div>
          <div class="inline">
            <input type="checkbox" id="size-l" name="sizes[]" value="L">
            <label for="size-l">L</label>
            <input type="number" id="quantity-l" name="quantities[]" placeholder="quantity" required>
          </div>
          <div class="inline">
            <input type="checkbox" id="size-xl" name="sizes[]" value="XL">
            <label for="size-xl">XL</label>
            <input type="number" id="quantity-xl" name="quantities[]" placeholder="quantity" required>
          </div>
        </div>
      </div>
      <div class="form-item">
        <label for="gender">Gender</label>
        <select name="gender" id="">
          <option value="">--Select--</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <div class="form-item">
        <label for="description">Description*</label>
        <textarea type="text" id="description" placeholder="Description" name="description"></textarea>
      </div>
      <div class="form-item">
        <label for="price">Price*</label>
        <input name="price" type="number" id="price" min="0" step="0.01" placeholder="Price" />
      </div>
      <div class="form-item">
        <label for="image">Select image:</label>
        <input type="file" name="image" accept="image/*" />
      </div>
      <div class="form-item">
        <label for="display-item">Display Item</label>
        <select name="display-item" id="">
          <option value="yes">Yes</option>
          <option value="no">No</option>
        </select>
      </div>
    <?php
        }
    ?>
  </div>
  </form>
  </div>
</body>

</html>