<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "connect.php";
// Check to make sure the id parameter is specified in the URL

$product_id = $_GET['product_id'];

if (isset($_GET['product_id'])) {
    // Prepare statement and execute, prevents SQL injection

    $stmt = $con->prepare('SELECT * FROM product WHERE product_id = ?');
    $stmt->bind_param('i', $_GET['product_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the product from the database and return the result as an Array
    $product = mysqli_fetch_assoc($result);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
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
    <link rel="stylesheet" href="product.css" />
    <title>Product | Vectory Zeuzera</title>
</head>

<body>
    <div class="wrapper">
        <?php include_once "header.php"; ?>
        <section class="product">
            <div class="product-images">
                <img class="product-img" src="./VZ/<?php echo $product['image']; ?>" alt="<?php echo $product['product_name']; ?>" />
                <div class="slider">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="grid-flow">
                <div class="message-fade">

                </div>
                <form action="" method="post" id="add-to-cart">
                    <div class="product-info">
                        <h2><?php echo $product['product_name']; ?></h2>
                        <span class="product-price">R<?php echo $product['price']; ?></span>

                        <div class="size">
                            <h3>Select Size:</h3>
                            <select id="size" name="size" required>
                                <option value="">--Please Select--</option>
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                        </div>

                        <div class="product-quantity">
                            <h3>Quantity</h3>
                            <input type="number" id="quantity" value="1" name="quantity" min="1" required />
                        </div>
                        <div class="product-description">
                            <h3>Description</h3>
                            <p>
                                <?php echo $product['description']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="fav-cart sticky">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                        <button id="add-to-cart__button" type="submit">Add To Cart</button>
                        <a href="add-to-wishlist.php?product_id=<?php echo $product['product_id']; ?>" id="favourite__button" class="add-to-wishlist">
                            <i class="far fa-heart"></i>
                        </a>
                    </div>
                </form>
            </div>
            <!-- Product added to cart message-->

        </section>

        <?php include_once "footer.php"; ?>
    </div>

    <script src="script.js"></script>
    <script defer src="add-to-cart.js"></script>
</body>

</html>