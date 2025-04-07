/** @format */

// update cart item quantity
let cartItem = document.getElementsByClassName("cart-item");
let itemQuantity = document.getElementsByClassName("item-quantity");
let updateBtn = document.getElementById("update-btn");
let itemPrice = document.querySelectorAll(".item-price");
let total = document.getElementsByClassName("total");
let totalProductCost;
let subtotal;

console.log(cartItem);

// remove item from cart
let remove = document.getElementsByClassName("remove");

for (let i = 0; i < remove.length; i++) {
  remove[i].addEventListener("click", function (event) {
    event.preventDefault();

    let productId = this.dataset.productId;
    console.log(productId);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "cart-functions.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    let params = "action=remove&product_id=" + productId;

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        let response = xhr.responseText;

        if (response == 1) {
          // Remove item from cart
          cartItem[i].remove();

          // Update subtotal
          updateSubtotal();

          // Update cart count
          updateCartCount();
        } else {
          // Handle the case where the removal was not successful
        }
      }
    };
    xhr.send(params);
  });
}

function updateSubtotal() {
  let subtotal = 0;
  for (let j = 0; j < total.length; j++) {
    subtotal += parseFloat(total[j].innerText.replace("R", ""));
  }
  document.getElementById("subtotal").innerText = `R${subtotal}`;
}

for (let i = 0; i < cartItem.length; i++) {
  itemQuantity[i].addEventListener("change", function (event) {
    event.preventDefault();

    let productId = document.querySelectorAll(".product-id");
    let quantity = this.value;
    if (isNaN(parseInt(quantity))) {
      quantity = 1;
    }

    let itemPriceValue = parseFloat(itemPrice[i].value || 0);
    let quantityValue = parseInt(quantity);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "cart-functions.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    params =
      "action=update&product_id=" +
      productId[i].value +
      "&quantity=" +
      quantity;

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        let response = xhr.responseText;

        if (response == 1) {
          // Update total
          totalProductCost = itemPriceValue * quantityValue;
          itemQuantity[i].value = quantity;
          total[i].innerText = `R${totalProductCost}`;

          // Update subtotal
          subtotal = 0;
          for (let j = 0; j < total.length; j++) {
            subtotal += parseFloat(total[j].innerText.replace("R", ""));
          }
          document.getElementById("subtotal").innerText = `R${subtotal}`;
        } else {
        }
      }
    };
    xhr.send(params);
  });
}
