<?php

if (isset($_SESSION['cart'])) {
    $cart_count = count($_SESSION['cart']);
} else {
    $cart_count = 0;
}
?>
<header>
    <div class="user-log">
        <?php
        if (!isset($_SESSION['loggedin'])) {
            echo "<a href='login.php' class='login'>Log in</a>";
            echo "<a href='register.php' class='register'>Join Us</a>";
        } else {
            # code...
            $sql = 'SELECT first_name FROM user WHERE user_id = ?';
            $stmt = $con->prepare($sql);
            $stmt->bind_param('i', $_SESSION['user_id']);
            $stmt->execute();
            $username = $stmt->store_result();
            $stmt->bind_result($username);
            $stmt->fetch();
            $stmt->close();

            echo "<p>Hi $username!</p>";
            echo "<a href='logout.php' class='logout'>Log out</a>";
        }
        ?>
    </div>
    <a href="#" class="open"><i class="fa-solid fa-bars"></i></a>

    <div class="top-nav">
        <div class="search-box__container center-align">
            <form action="" method="post">
                <input id="search-field" type="text" class="search-field" autocomplete="off" />
                <button type="submit" class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            <div class="search-results">
                <ul class="search-results__list">
                    <!-- search results will be displayed here -->
                </ul>
            </div>
        </div>
        <div class="right-align icons">
            <a href="#" class="open-search__bx"><i class="fa-solid fa-magnifying-glass"></i></a>
            <a href="wishlist.php" class="wishlist">
                <i class="header-icon fa fa-heart"></i>
            </a>
            <a href="dashboard.php" class="header-icon profile-pic"><i class="fa-regular fa-user"></i></a>
            <a href="cart.php" class="header-icon shopping-cart"><i class="fas fa-shopping-cart"></i><span class="cart-count"></span></a>
        </div>
    </div>


    <nav class="desktop-nav">
        <ul>
            <li class="nav-link"><a href="index.php">HOME</a></li>
            <li class="nav-link"><a href="catalog.php?gender=Male">MEN</a></li>
            <li class="nav-link"><a href="catalog.php?gender=Female">WOMEN</a></li>
            <li class="nav-link"><a href="about.php">ABOUT</a></li>
            <li class="nav-link"><a href="contact.php">CONTACT</a></li>
        </ul>
    </nav>


    <nav class="mobile-nav">
        <a href="#" class="close"><i class="fa-regular fa-x"></i></a>
        <ul>
            <li class="nav-link"><a href="index.php">HOME</a></li>
            <li class="nav-link"><a href="catalog.php?gender=Male">MEN</a></li>
            <li class="nav-link"><a href="catalog.php?gender=Female">WOMEN</a></li>
            <li class="nav-link"><a href="about.php">ABOUT</a></li>
            <li class="nav-link"><a href="contact.php">CONTACT</a></li>
        </ul>

        <?php
        if (isset($_SESSION['loggedin'])) {
            # code...
            echo "<a href='logout.php' class='btn logout'>LOG OUT</a>";
        } else {
            echo "<a href='login.php' class='btn login'>LOG IN</a>";
            echo "<a href='register.php' class='btn register'>REGISTER</a>";
        }
        ?>
    </nav>

    <div class="cart">
        <div class="cart-header">
            <h3>Cart (<span></span>)</h3>
            <a href="#" class="close close-cart"><i class="fa-regular fa-x"></i></a>
        </div>
        <div class="cart-items">

        </div>

        <div class="cart__buttons">
            <button class="checkout">PROCEED TO CHECKOUT</button>
            <button class="shopping-bag" onclick="showCart()">VIEW SHOPPING BAG</button>
        </div>
    </div>
</header>
<script>
    // UPDATE CART COUNT
    let cartCount = document.getElementsByClassName("cart-count")[0];

    function updateCartCount() {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", `cart-count.php`, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = xhr.responseText;

                cartCount.innerText = response;
            }
        };
        xhr.send();
    }
    updateCartCount();
</script>