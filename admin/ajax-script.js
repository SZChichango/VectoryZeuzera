document.addEventListener("DOMContentLoaded", function () {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch-products.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);

            let response = JSON.parse(xhr.responseText);

            let html = '';

            // Iterate through the data
            for (let i = 0; i < response.length; i++) {
                html += `
          <tr>
                <td><input type="checkbox" name="select" id="" /></td>
                <td>${response[i].itemID}</td>
                <td>${response[i].sku}</td>
                <td>${response[i].item_name}</td>
                <td>${response[i].category}</td>
                <td>${response[i].gender}</td>
                <td><span class="status">active</span></td>
                <td>${response[i].price}</td>
                <td>${response[i].stock_quantity}</td>
                <td>
                  <a href="#" class="edit-product">Edit</a>
                  <a href="#" class="delete-product">Delete</a>
                </td>
              </tr>
        `;
            }

            // Append the data to the DOM
            document.getElementsByClassName("products-data")[0].innerHTML = html;
        }
    };
    xhr.send();
});