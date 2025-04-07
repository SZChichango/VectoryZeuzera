/** @format */

document.addEventListener("DOMContentLoaded", function () {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "fetch-catalog.php", true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log(xhr.responseText);

      let response = JSON.parse(xhr.responseText);
      console.log(response[0].image);
      let html = "";

      // Iterate through the data
      for (let i = 0; i < response.length; i++) {
        html += `
          <div class="item">
            <img src="${response[i].image}" alt="item" />
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
  xhr.send();
});
