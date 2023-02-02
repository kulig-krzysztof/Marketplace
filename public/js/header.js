const toggleButton = document.querySelector(".menu");
const menu = document.querySelector("#menu");
const body = document.querySelector("body");

toggleButton.addEventListener("click", function() {
    menu.style.display = menu.style.display === "none" ? "block" : "none";
});
