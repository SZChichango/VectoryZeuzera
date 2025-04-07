<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "connect.php";

if (!($_SESSION['loggedin'])) {
    # code...
    header("location: login.php");
    //Fetch data from the database
}

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = array();
}

if (isset($_POST['product_id'], $_POST['quantity'], $_POST['size'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];

    $product = array(
        'product_id' => $product_id,
        'quantity' => $quantity,
        'size' => $size
    );

    $cart[] = $product;

    $_SESSION['cart'] = $cart;

    header('Location: product.php?product_id=' . $product_id);
    exit();
}

if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart'])) {
    $product_id = $_GET['remove'];

    foreach ($cart as $key => $product) {
        if ($product['product_id'] == $product_id) {
            unset($cart[$key]);
            break;
        }
    }

    $_SESSION['cart'] = $cart;
    header('Location: cart.php');
    exit();
}

// Calculate the subtotal
function calculateSubtotal($cart, $con)
{
    $subtotal = 0;

    foreach ($cart as $product) {
        $product_id = $product['product_id'];
        $quantity = $product['quantity'];

        $stmt = $con->prepare("SELECT price FROM product WHERE product_id = ?");
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = mysqli_fetch_assoc($result)) {
            $price = $row['price'];
            $subtotal += $price * $quantity;
        }
    }

    return $subtotal;
}

// Update product quantities in cart
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    $newCart = array();

    foreach ($cart as $product) {
        $product_id = $product['product_id'];
        $quantity = $_POST['quantity-' . $product_id];

        if (is_numeric($quantity) && $quantity > 0) {
            $product['quantity'] = $quantity;
            $newCart[] = $product;
        }
    }

    $_SESSION['cart'] = $newCart;
    header('Location: cart.php');
    exit();
}

// Check if the cart is empty
$cartIsEmpty = empty($cart);

// store cart items in a table

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
    <link rel="stylesheet" href="cart.css" />

    <title>Cart | Vectory Zeuzera</title>
</head>

<body>
    <div class="wrapper">
        <?php include_once "header.php"; ?>
        <section class="cart-wrapper">
            <form action="checkout.php" method="post">
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Product</td>
                            <td>Price</td>
                            <td>Size</td>
                            <td>Quantity</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($cartIsEmpty) { ?>
                            <tr>
                                <td colspan="6" style="text-align:center;">You have no products added in your Shopping Cart</td>
                            </tr>
                        <?php } else { ?>
                            <?php
                            foreach ($cart as $product) {
                                $product_id = $product['product_id'];
                                $quantity = $product['quantity'];

                                $stmt = $con->prepare("SELECT * FROM product WHERE product_id = ?");
                                $stmt->bind_param('i', $product_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td class="img">
                                            <a href="#">
                                                <img src="./VZ/<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?>" />
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#">Vectory Zeuzera</a>
                                            <br />
                                            <a href="cart.php?remove=<?php echo $product_id; ?>" class="remove">Remove</a>
                                        </td>
                                        <td class="price">R<?php echo $row['price']; ?></td>
                                        <td>L</td>
                                        <td class="quantity">
                                            <input type="number" name="quantity-<?php echo $product_id; ?>" min="1" max="" value="<?php echo $quantity; ?>" required />
                                        </td>
                                        <td class="price">R<?php echo $row['price'] * $quantity; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        <?php } ?>
                    </tbody>
                </table>
                <?php if (!$cartIsEmpty) { ?>


                    <div class="subtotal">
                        <span class="text">Subtotal</span>
                        <span class="price">R<?php echo calculateSubtotal($cart, $con); ?></span>
                    </div>
                    <div class="buttons">
                        <button type="submit" name="update">Update Cart</button>

                        <input type="hidden" name="subtotal" value="<?php echo calculateSubtotal($cart, $con); ?>">
                        <button type="submit" name="checkout">Checkout</button>

                    </div>
                <?php } ?>
            </form>
        </section>
        <?php include_once "footer.php"; ?>
    </div>
    <script src="script.js"></script>
</body>

</html>