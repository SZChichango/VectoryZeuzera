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

$sql = 'SELECT user.first_name, user.last_name, user.email, user.cellphone_number, user.dob FROM user WHERE user_id = ?';
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$data = mysqli_fetch_assoc($result);

// get address data
$sql = 'SELECT * FROM address WHERE user_id = ?';
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$resultAdd = $stmt->get_result();

// Get order details
$sql = 'SELECT * FROM `order` WHERE user_id = ?';
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$resultOrder = $stmt->get_result();



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
  <link rel="stylesheet" href="dashboard.css" />
  <title>Account | Vectory Zeuzera</title>
</head>

<body>
  <div class="wrapper">
    <?php include_once "header.php"; ?>

    <section class="dashboard-flex">
      <ul class="dashboard-header__flex">
        <li class="dh-link"><a href="#pdetails">Personal Details</a></li>
        <li class="dh-link"><a href="#orders">Orders</a></li>
        <li class="dh-link"><a href="#addresses">Addresses</a></li>
        <li class="dh-link"><a href="#gift-card">Gift Cards</a></li>
      </ul>

      <div id="pdetails" class="pdetails-grid">
        <div class="pdetail edit">
          <div class="pdetail-header">
            <h3>Name</h3>
            <a href="#">edit</a>
          </div>
          <p class="field"><?php echo $data['first_name'] . ' ' . $data['last_name']; ?></p>
        </div>

        <div class="pdetail edit">
          <div class="pdetail-header">
            <h3>Email</h3>
            <a href="#" class="edit">edit</a>
          </div>
          <p class="field"><?php echo $data['email']; ?></p>
        </div>

        <div class="pdetail edit">
          <div class="pdetail-header">
            <h3>Mobile Number</h3>
            <a href="#" class="edit">edit</a>
          </div>
          <p class="field"><?php echo $data['cellphone_number']; ?></p>
        </div>

        <div class="pdetail edit">
          <div class="pdetail-header">
            <h3>Date of birth</h3>
            <a href="#" class="edit">edit</a>
          </div>
          <p class="field"><?php echo $data['dob']; ?></p>
        </div>
      </div>
      <div id="orders" class="orders-flex">
        <h2>Order history</h2>
        <?php
        while ($order_data = $resultOrder->fetch_assoc()) {
        ?>
          <div class="order-flex">
            <h3>Order Number: <?php echo $order_data['order_id']; ?>, <?php echo $order_data['order_date']; ?></h3>
            <p>Made By: <span><?php echo $order_data['name']; ?></span></p>
            <button class="toggle-details">Details</button>
            <div class="order-details__grid">
              <div class="order-address">
                <h3>Shipping Address</h3>
                <p class="order-address">
                  <?php echo $order_data['address'] . "," . $order_data['zip_code']; ?> <br />
                </p>
              </div>
              <div class="delivery-method">
                <h3>Delivery Method</h3>
                <p>Standard</p>
              </div>
              <div class="payment-method">
                <h3>Payment Method</h3>
                <p>Credit / Debit Card</p>
              </div>
              <div class="order-summary">
                <h3>Order Summary</h3>
                <p>
                  <span class="item-count"><?php echo $order_data['items_count']; ?></span> Item(s)
                  <span class="items-total"><?php echo $order_data['order_amount'] - 100; ?></span>
                </p>
                <p>Delivery R<span>100</span></p>
                <p>Order Total: R<span class="order-total"><?php echo $order_data['order_amount']; ?></span></p>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
      <div id="addresses" class="addresses addresses-flex">
        <h2>Addresses</h2>
        <div class="address-container">
          <div class="saved-addresses">
            <div class="address-header">
              <h3>Your Addresses</h3>
              <a href="#" class="edit">edit</a>
            </div>
            <?php
            while ($row = $resultAdd->fetch_assoc()) {
            ?>
              <div class="address">
                <p>
                  <?php echo $row['name']; ?> <span class="country"><?php echo $row['country']; ?></span>
                </p>
              </div>
            <?php
            }
            ?>

          </div>
          <div class="add-address">
            <h3>Add Address</h3>
            <form action="add-address.php" method="post" class="add-address__form">
              <div class="add-address__form--input">
                <label for="first-name">Name<span>*</span></label>
                <input type="text" id="name" name="name" placeholder="Name" required />
              </div>

              <div class="add-address__form--input">
                <label for="address">Address<span>*</span></label>
                <input type="text" id="address" name="address" placeholder="Address" required />
              </div>
              <div class="add-address__form--input">
                <label for="country">Country<span>*</span></label>
                <select name="country" id="" required>
                  <option value="" selected>Select Country</option>
                  <option value="South Africa">South Africa</option>
                  <option value="Nigeria">Nigeria</option>
                  <option value="Kenya">Kenya</option>
                  <option value="Tanzania">Tanzania</option>
                  <option value="Uganda">Uganda</option>
                  <option value="Zambia">Zambia</option>
                  <option value="Burundi">Burundi</option>
                  <option value="Rwanda">Rwanda</option>
                  <option value="Burkina Faso">Burkina Faso</option>
                  <option value="Zimbabwe">Zimbabwe</option>
                  <option value="Senegal">Senegal</option>
                  <option value="Ghana">Ghana</option>
                  <option value="Togo">Togo</option>
                  <option value="Benin">Benin</option>
                  <option value="Gambia">Gambia</option>
                  <option value="Guinea">Guinea</option>
                  <option value="Liberia">Liberia</option>
                  <option value="Sierra Leone">Sierra Leone</option>
                  <option value="Ethiopia">Ethiopia</option>
                  <option value="Togo">Togo</option>
                  <option value="Benin">Benin</option>
                </select>
              </div>
              <div class="add-address__form--input">
                <label for="city">City<span>*</span></label>
                <input type="text" name="city" placeholder="City" />
              </div>
              <div class="add-address__form--input">
                <label for="state">State<span>*</span></label>
                <input type="text" name="state" placeholder="State" />
              </div>
              <div class="add-address__form--input">
                <label for="postal">Postal Code<span>*</span></label>
                <input type="text" name="post_code" placeholder="Postal Code" />
              </div>
              <div class="add-address__form--input">
                <label for="phone">Phone<span>*</span></label>
                <input type="text" name="phone" placeholder="Phone" />
              </div>
              <div class="add-address__form--input checkbox">
                <label for="default-address">Set as default address</label>
                <input type="checkbox" name="default-address" id="default-address" value="1" />
              </div>
              <button type="submit">Add Address</button>
            </form>
          </div>
        </div>
      </div>
    </section>
    <?php include_once "footer.php"; ?>
  </div>
  <script src="script.js"></script>
</body>

</html>