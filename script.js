/** @format */

// Side navigation Mobile
let menu = document.getElementsByClassName("mobile-nav")[0];
let openMenu = document.getElementsByClassName("open")[0];
let closeMenu = document.getElementsByClassName("close")[0];

openMenu.addEventListener("click", () => {
  menu.classList.toggle("active");
});

closeMenu.addEventListener("click", () => {
  menu.classList.toggle("active");
});

// Fetch the results from livesearch.php
let search = document.getElementById("search-field");
let searchResults = document.getElementsByClassName("search-results__list")[0];
console.log(searchResults);
search.addEventListener("keyup", () => {
  let searchValue = search.value;
  let result = "";
  if (searchValue.length > 0) {
    fetch("livesearch.php", {
      method: "POST",
      body: new URLSearchParams("search=" + searchValue),
    })
      .then((response) => response.text())
      .then((data) => {
        data = JSON.parse(data);
        console.log(data);
        for (let i = 0; i < data.length; i++) {
          // display the search results with the links
          result += `<li><a href="product.php?product_id=${data[i].product_id}">${data[i].product_name}</a></li>`;
        }
        searchResults.innerHTML = result;
      });
  } else {
    searchResults.innerHTML = "No Results Found";
  }
});

// Cart side nav
let cart = document.getElementsByClassName("cart")[0];
let openCart = document.getElementsByClassName("shopping-cart")[0];
let closeCart = document.getElementsByClassName("close-cart")[0];

openCart.addEventListener("click", () => {
  cart.classList.toggle("active");
});

closeCart.addEventListener("click", () => {
  cart.classList.toggle("active");
});

// Order details
let order = document.getElementsByClassName("order-flex");
let orderDetails = document.getElementsByClassName("order-details__grid");
let detailsButton = document.getElementsByClassName("toggle-details");

for (let i = 0; i < detailsButton.length; i++) {
  detailsButton[i].addEventListener("click", () => {
    orderDetails[i].classList.toggle("active");
  });
}

//Add to Cart
let addToCartBtns = document.getElementsByClassName("add");
let productName = document.getElementsByClassName("product-name");
let productPrice = document.getElementsByClassName("price");
let productImage = document.getElementsByClassName("product-image");
let cartItems = document.getElementsByClassName("cart-items")[0];

for (let i = 0; i < addToCartBtns.length; i++) {
  addToCartBtns[i].addEventListener("click", () => {
    console.log("Clicked");
    let cartItem = document.createElement("div");
    cartItem.classList.add("cart-item");
    cartItem.innerHTML = `
     <div class="container-flex">
                <div class="flex-1">
                  <img
                    class="product-image"
                    src="${productImage[i].src}"
                    alt=""
                  />
                </div>

                <div class="flex-2">
                  <h3 class="product-name">${productName[i].innerHTML}</h3></h3>
                  <span class="quantity">1</span>
                  X
                  <span class="item-price">${productPrice[i].innerHTML}</span>
                  <a href="#" class="remove-item">Remove</a>
                </div>
              </div>
              <div class="item-quantity">
                <span class="quantity-subtract"
                  ><i class="fa-solid fa-minus"></i
                ></span>
                <input
                  class="quantity-value"
                  type="number"
                  value="1"
                  name="quantity"
                  required
                />
                <span class="quantity-add"
                  ><i class="fa-solid fa-plus"></i
                ></span>
              </div>
    `;
    cartItems.append(cartItem);

    console.log(productName[i], productImage[i].src, productPrice[i]);
  });
}

// Add to Favourites
let addToFavourites = document.getElementsByClassName("favourite");

for (let i = 0; i < addToFavourites.length; i++) {
  addToFavourites[i].addEventListener("click", () => {
    console.log("Clicked 2");
  });
}

// Remove from Cart
let removeBtn = document.getElementsByClassName("remove-item");
for (let i = 0; i < removeBtn.length; i++) {
  removeBtn[i].addEventListener("click", () => {
    console.log("Clicked 3");
    removeBtn[i].parentElement.parentElement.parentElement.remove();
  });
}

// Open shopping cart
function showCart() {
  console.log("clicked");
  window.location.href = "cart.php";
}

// Filter Side nav
let filter = document.getElementsByClassName("filter-flex")[0];
let openFilter = document.getElementsByClassName("filter-activate")[0];
let closeFilter = document.getElementsByClassName("close-filter")[0];

openFilter.addEventListener("click", () => {
  filter.classList.toggle("active");
});

closeFilter.addEventListener("click", () => {
  filter.classList.toggle("active");
});

// Filter accordion
let accordion = document.getElementsByClassName("accordion-button");
let accordionContent = document.getElementsByClassName("accordion-content");
for (let i = 0; i < accordion.length; i++) {
  accordion[i].addEventListener("click", () => {
    accordionContent[i].classList.toggle("active");
  });
}
