/** @format */

document
  .getElementById("checkout-form")
  .addEventListener("submit", function (event) {
    let cardNumber = document.getElementById("card-number").value;
    let expiryDate = document.getElementById("expiry-date").value;
    let expiryError = document.getElementById("expiry-error");
    expiryError.textContent = "";

    // Validate credit card number using Luhn algorithm
    if (!validateCardNumber(cardNumber)) {
      event.preventDefault();
      alert("Invalid credit card number!");
      return;
    }

    // Validate expiry date format
    if (!validateExpiryDate(expiryDate)) {
      event.preventDefault();
      expiryError.textContent = "Invalid expiry date format (MM/YY)";
      return;
    }
  });

// Luhn algorithm for credit card number validation
function validateCardNumber(cardNumber) {
  let sum = 0;
  let shouldDouble = false;
  for (let i = cardNumber.length - 1; i >= 0; i--) {
    let digit = parseInt(cardNumber.charAt(i));

    if (shouldDouble) {
      digit *= 2;
      if (digit > 9) {
        digit -= 9;
      }
    }

    sum += digit;
    shouldDouble = !shouldDouble;
  }
  return sum % 10 === 0;
}

// Basic format validation for expiry date (MM/YY)
function validateExpiryDate(expiryDate) {
  let pattern = /^(0[1-9]|1[0-2])\/\d{2}$/;
  return pattern.test(expiryDate);
}
