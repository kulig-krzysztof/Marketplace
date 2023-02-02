const buttons = document.querySelector(".category");

buttons.addEventListener("mouseenter", function() {
    buttons.style.transform = "scale(1.1)";
});

buttons.addEventListener("mouseleave", function() {
    buttons.style.transform = "scale(1)";
});


