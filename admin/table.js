/** @format */

let checkboxes = document.getElementsByTagName("input");

function checkAll(bx) {
  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].type == "checkbox") {
      checkboxes[i].checked = bx.checked;
    }
  }
}
