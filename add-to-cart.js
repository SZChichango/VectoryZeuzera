/** @format */

// Add product to cart
let addToCartForm = document.getElementById("add-to-cart");
addToCartForm.addEventListener("submit", function (event) {
  event.preventDefault();
});

let addToCart = document.getElementById("add-to-cart__button");
let productQuantity = document.getElementById("quantity");
let productSize = document.getElementById("size");
let product_id = document.querySelector("input[name='product_id']").value;

addToCart.addEventListener("click", () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", `add-to-cart.php`, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  let params = `action=add&product_id=${product_id}&quantity=${productQuantity.value}&size=${productSize.value}`;

  function removeFadeOut(el, speed) {
    var seconds = speed / 1000;
    el.style.transition = "opacity " + seconds + "s ease";

    el.style.opacity = 0;
    setTimeout(function () {
      el.parentNode.removeChild(el);
    }, speed);
  }

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log(xhr.responseText);
      let response = xhr.responseText;
      if (response == 1) {
        // Display a success message
        document.getElementsByClassName(
          "message-fade"
        )[0].innerHTML = `<div class="product-added">
            <div class="add-to-cart__message">
                <p class="success">Product added to cart</p>
            </div>
        </div>`;
        updateCartCount();
        removeFadeOut(
          document.getElementsByClassName("product-added")[0],
          5000
        );
      } else if (response == 2) {
        // Display product updated message
        document.getElementsByClassName(
          "message-fade"
        )[0].innerHTML = `<div class="product-added">
            <div class="add-to-cart__message">
                <p class="success">Product already exists in the cart!</p>
            </div>
        </div>`;
      } else {
        // Display an error message
        document.getElementsByClassName(
          "message-fade"
        )[0].innerHTML = `<div class="product-added__error">
            <div class="add-to-cart__message">
                <p class="success">Error adding product to cart</p>
            </div>
        </div>`;
        removeFadeOut(
          document.getElementsByClassName("product-added")[0],
          5000
        );
      }
    }
  };
  xhr.send(params);
});
