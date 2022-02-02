<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/categories.css">
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyszukaj</title>
</head>
<body>
    <div class="base-container">
        <div class="header">
            <img class="logo-img" src="public/img/logo.svg">
            <button class="account">
                Konto
                <i class="fas fa-user"></i>
            </button>
        </div>
        <div class="search">
            <form class="search-bar">
            <div class="input-container">
                <i class="fas fa-search"></i>
                <input type="text" class="name-search" placeholder="Czego szukasz?">
            </div>
            <div class="input-container">
                <i class="fas fa-thumbtack"></i>
                <input type="text" class="location" placeholder="Lokalizacja">
            </div>
                <button class="search-button">Szukaj</button>
            </form>
        </div>
        <div class="category-container">
                <div class="text">
                    Kategorie
                </div>
            <div class="categories">
                <button class="category">
                    <img class="category-img" src="public/img/uploads/shoes.jpg">
                    Buty
                </button>
                <button class="category">
                    <img class="category-img" src="public/img/uploads/tshirts.jpg">
                    Koszulki
                </button>
                <button class="category">
                    <img class="category-img" src="public/img/uploads/hoodies.jpg">
                    Bluzy
                </button>
                <button class="category">
                    <img class="category-img" src="public/img/uploads/jackets.jpg">
                    Kurtki
                </button>
                <button id="last-cat" class="category">
                    <img class="category-img" src="public/img/uploads/caps.jpg">
                    Akcesoria
                </button>
            </div>
        </div>
        <footer>
            <div>@ 2022 Krzysztof Kulig</div>
            <div>
                <i class="fab fa-facebook"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-github"></i>
            </div>
        </footer>
    </div>
</body>
</html>