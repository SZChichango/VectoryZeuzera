<?php
include "connect.php";

//Fetch data from the database
$gender = $_GET['gender'];

$sql = "SELECT product_id, product_name, image, price, category FROM product WHERE gender = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $gender);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

// get the mysqli result


// $con->close();
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
  <meta name="products-gender" content="<?php echo $gender; ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="catalog.css" />
  <title>Vectory Zeuzera | E-Commerce Store</title>
</head>

<body>
  <div class="wrapper">
    <?php include_once "header.php"; ?>

    <section class="catalog-grid">
      <!-- <h2>Loren & Ipsum</h2> -->

      <div class="sort-flex">
        <span>Sort by:</span>
        <select name="sort_by" class="facet-filters__sort select__select caption-large" id="SortBy" aria-describedby="a11y-refresh-page-message">
          <option value="manual">Featured</option>
          <option value="best-selling">Best selling</option>
          <option value="title-ascending">Alphabetically, A-Z</option>
          <option value="title-descending">Alphabetically, Z-A</option>
          <option value="price-ascending">Price, low to high</option>
          <option value="price-descending">Price, high to low</option>
          <option value="created-ascending">Date, old to new</option>
          <option value="created-descending" selected="selected">
            Date, new to old
          </option>
        </select>

        <span class="sort-result-count">0 </span>
        <span>Products</span>
      </div>

      <a href="#" class="filter-activate">Filter
        <i class="fas fa-filter"></i>
      </a>
      <aside class="filter-flex">
        <form action="" class="filter" method="post">
          <div class="filter-main-collection">
            <div class="filter-header">
              <h4>Filter:</h4>
              <a href="#" class="close-filter">
                <i class="fas fa-times"></i>
              </a>
            </div>

            <div class="filter-accordion">
              <div class="accordion-item">
                <div class="accordion-button">Category</div>
                <div class="accordion-content">
                  <div class="option">
                    <input type="checkbox" name="category[]" value="T-Shirts" />
                    <label for="checkbox">T-Shirts</label>
                  </div>
                  <div class="option">
                    <input type="checkbox" name="category[]" value="Hoodies" />
                    <label for="checkbox">Hoodies</label>
                  </div>
                  <div class="option">
                    <input type="checkbox" name="category[]" value="Jackets" />
                    <label for="checkbox">Jackets</label>
                  </div>
                  <div class="option">
                    <input type="checkbox" name="category[]" value="Trousers" />
                    <label for="checkbox">Trousers</label>
                  </div>
                  <div class="option">
                    <input type="checkbox" name="category[]" value="Shorts" />
                    <label for="checkbox">Shorts</label>
                  </div>
                  <div class="option">
                    <input type="checkbox" name="category[]" value="Accessories" />
                    <label for="checkbox">Accessories</label>
                  </div>
                  <div class="option">
                    <input type="checkbox" name="category[]" value="Socks" />
                    <label for="checkbox">Socks</label>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <div class="accordion-button">Size</div>
                <div class="accordion-content">
                  <div class="option">
                    <input type="checkbox" name="size[]" value="XS" />
                    <label for="size">XS</label>
                  </div>
                  <div class="option">
                    <input type="checkbox" name="size[]" value="S" />
                    <label for="size">S</label>
                  </div>
                  <div class="option">
                    <input type="checkbox" name="size[]" value="M" />
                    <label for="size">M</label>
                  </div>
                  <div class="option">
                    <input type="checkbox" name="size[]" value="L" />
                    <label for="size">L</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <div class="accordion-button">Price</div>
              <div class="accordion-content">
                <div class="price-range">
                  <input type="number" name="from" id="" placeholder="From $" />
                  <input type="number" name="to" id="" placeholder="To $" />
                </div>
              </div>
            </div>
            <button id="filter-btn">Filter</button>
            <button type="reset">Reset</button>
          </div>
        </form>
      </aside>

      <div class="items">
        <div class="item">
          <div class="img-skeleton skeleton"></div>
          <div class="skeleton skeleton-text"></div>
          <div class=" skeleton skeleton-text__body skeleton-text"></div>
          <div class="skeleton price-skeleton skeleton-text skeleton-footer"></div>
        </div>
      </div>
    </section>
    <?php include_once "footer.php"; ?>
  </div>
  <script src="script.js"></script>
  <script defer src="ajax-script.js"></script>
</body>

</html>