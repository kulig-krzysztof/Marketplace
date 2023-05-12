const toggleButton = document.querySelector(".menu");
const menu = document.querySelector("#menu");
const body = document.querySelector("body");

toggleButton.addEventListener("click", function() {
    menu.style.display = menu.style.display === "none" ? "block" : "none";
});

const filterButton = document.querySelector("#filter-icon");

filterButton.addEventListener('click', function(event) {
    event.preventDefault();
    document.querySelector("#close").removeAttribute("id");
    filterButton.classList.add("filter-button-active");
    filterButton.style.display = "none";
    filterButton.removeAttribute("id");
    document.querySelector(".filters-container").classList.add("filters-container-active");
    document.querySelector(".filters-container").classList.remove("filters-container");
});
