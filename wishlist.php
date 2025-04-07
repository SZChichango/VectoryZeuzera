<?php
include "connect.php";

// fetch wishlist products
$stmt = $con->prepare("SELECT * FROM wishlist WHERE user_id = ?");
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$wishlist = $result->fetch_all(MYSQLI_ASSOC);
// fetch products
$wishlist_products = array();
foreach ($wishlist as $product) {
  $product_id = $product['product_id'];
  $stmt = $con->prepare("SELECT * FROM product WHERE product_id = ?");
  $stmt->bind_param('i', $product_id);
  $stmt->execute();
  $resultProducts = $stmt->get_result();
}
// remove product from wishlist
if (isset($_GET['remove']) && is_numeric($_GET['remove'])) {
  $product_id = $_GET['remove'];
  $user_id = $_SESSION['user_id'];
  $stmt = $con->prepare("DELETE FROM wishlist WHERE product_id = ? AND user_id = ?");
  $stmt->bind_param('ii', $product_id, $user_id);
  $stmt->execute();
  header('location: wishlist.php');
  exit;
}
// add product to cart
// if (isset($_['']) && is_numeric($_GET['add'])) {
//   $product_id = $_GET['add'];
//   $quantity = 1;
//   $product = array(
//     'product_id' => $product_id,
//     'quantity' => $quantity
//   );
//   if (isset($_SESSION['cart'])) {
//     $cart = $_SESSION['cart'];
//   } else {
//     $cart = array();
//   }
//   $cart[] = $product;
//   $_SESSION['cart'] = $cart;
//   header('Location: product.php?product_id=' . $product_id);
//   exit();
// }



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
  <link rel="stylesheet" href="wishlist.css" />
  <title>My Wishlist | Vectory Zeuzera</title>
</head>

<body>
  <div class="wrapper">
    <?php include_once "header.php" ?>
    <section class="wishlist-container">
      <h2>Wishlist</h2>
      <div class="wishlist-items">

        <?php
        if ($result->num_rows <= 0) {
          # code...
          echo "<p style='text-align:center' >No items in the wishlist</p>";
        } else {

          while ($row = $resultProducts->fetch_assoc()) {
        ?>
            <form action="add-to-cart.php" method="post">
              <div class="wish-item">
                <div class="wish_flex-1">
                  <img class="product-image" src="VZ/<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?>" srcset="" />
                </div>
                <div class="wish_flex-2">
                  <h4 class="product-name"><?php echo $row['product_name']; ?></h4>
                  <p>$<span class="product-price"><?php echo $row['price']; ?></span></p>
                  <div class="wish-btns">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="add">Add To Cart</button>
                    <a class="remove" href="wishlist.php?remove=<?php echo $product_id; ?>" class="remove">Remove</a>
                  </div>
                </div>
              </div>
            </form>
        <?php
          }
        }
        ?>

      </div>
    </section>
    <?php include_once "footer.php" ?>
  </div>
  <script src="script.js"></script>
</body>

</html>