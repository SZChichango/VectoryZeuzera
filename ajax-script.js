/** @format */

let products;

document.addEventListener("DOMContentLoaded", function () {
  // fetch content on meta tag
  const gender = document.querySelector("meta[name='products-gender']").content;
  console.log(gender);

  let xhr = new XMLHttpRequest();
  xhr.open("GET", `fetch-catalog.php?gender=${gender}`, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log(xhr.responseText);

      let response = JSON.parse(xhr.responseText);

      let html = "";

      // Iterate through the data
      for (let i = 0; i < response.length; i++) {
        html += `
          <div class="item">
            <img src="./VZ/${response[i].image}" alt="item" />
            <p>${response[i].product_name}</p>
            <p class="item-category">${response[i].category}</p>
            <span class="price">R${response[i].price}</span>
          </div>
        `;
      }
      // Append the data to the DOM
      document.getElementsByClassName("items")[0].innerHTML = html;
      document.addEventListener("click", function (event) {
        // Check if the clicked element is an item
        if (event.target.classList.contains("item")) {
          // Get the index of the clicked item
          let index = Array.from(event.target.parentNode.children).indexOf(
            event.target
          );

          // Redirect to the product page with the item details
          window.location.href = `product.php?product_id=${response[index].product_id}`;
          console.log(response[i].product_id);
        }
      });
    }
  };
  xhr.send();
});

// Filter products
let filterForm = document.getElementsByClassName("filter")[0];
filterForm.addEventListener("submit", function (event) {
  event.preventDefault();
});

let filterBtn = document.getElementById("filter-btn");

// Filter products once the filter button is clicked
filterBtn.addEventListener("click", () => {
  let categories = document.querySelectorAll(
    'input[name="category[]"]:checked'
  );
  let sizes = document.querySelectorAll('input[name="size[]"]:checked');

  let categoryValues = Array.from(categories).map((input) => input.value);
  let sizeValues = Array.from(sizes).map((input) => input.value);

  let startingPrice = document.querySelector('input[name="from"]').value;
  let endingPrice = document.querySelector('input[name="to"]').value;

  let xhr = new XMLHttpRequest();
  xhr.open("POST", `filter.php`, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  let params = `action=filter&categories=${categoryValues.join(
    ","
  )}&sizes=${sizeValues.join(",")}&from=${startingPrice || "null"}&to=${
    endingPrice || "null"
  }&status=1`;

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log(xhr.responseText);

      let response = JSON.parse(xhr.responseText);

      let html = "";

      // Iterate through the data
      for (let i = 0; i < response.length; i++) {
        html += `
          <div class="item">
            <img src="./VZ/${response[i].image}" alt="${response[i].product_name}" />
            <p>${response[i].product_name}</p>
            <p class="item-category">${response[i].category}</p>
            <span class="price">R${response[i].price}</span>
          </div>
        `;
      }
      // Append the data to the DOM
      document.getElementsByClassName("items")[0].innerHTML = html;
    }
  };
  xhr.send(params);
  // Move it outside the xhr.onreadystatechange callback
  document.addEventListener("click", function (event) {
    // Check if the clicked element is an item
    if (event.target.closest(".item")) {
      // Get the index of the clicked item
      let index = Array.from(
        event.target.closest(".item").parentNode.children
      ).indexOf(event.target.closest(".item"));

      // Redirect to the product page with the item details
      window.location.href = `product.php?product_id=${response[index].product_id}`;
    }
  });
});
