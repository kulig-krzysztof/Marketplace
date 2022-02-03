const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const phoneInput = form.querySelector('input[name="phone"]');
const priceInput = form.querySelector('input[name="price"]');

function numberCheck (number) {
    return /^[1-9][0-9]{8}/.test(number);
}

function priceCheck (price) {
    return /^[1-9][0-9]*/.test(price);
}

function isEmail (email) {
    return /\S+@\S+\.\S+/.test(email);
}

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

function validateNumber() {
    setTimeout(function () {
        markValidation(phoneInput, numberCheck(phoneInput.value));
    }, 1000);
}

function validatePrice() {
    setTimeout(function () {
        markValidation(priceInput, priceCheck(priceInput.value));
    }, 1000);
}

function validateEmail() {
    setTimeout(function () {
            markValidation(emailInput, isEmail(emailInput.value));
        },
        1000
    );
}

phoneInput.addEventListener('keyup', validateNumber);
priceInput.addEventListener('keyup', validatePrice);
emailInput.addEventListener('keyup', validateEmail);