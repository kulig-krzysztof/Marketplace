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
        <?php include('header.php') ?>
        <div class="search">
            <form action="categories" method="get" class="search-bar">
            <div class="input-container">
                <i class="fas fa-search"></i>
                <input name="name-search" type="text" class="name-search" placeholder="Czego szukasz?">
            </div>
            <div class="input-container">
                <i class="fas fa-thumbtack"></i>
                <input type="text" class="location" placeholder="Lokalizacja">
            </div>
                <button type="submit" class="search-button">Szukaj</button>
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
        <?php include('footer.php') ?>
    </div>
</body>
</html>