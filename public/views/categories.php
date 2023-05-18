<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/categories.css">
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyszukaj</title>
</head>
<body>
    <div class="base-container">
        <?php include('header.php') ?>
        <div class="search">
            <form action="results" method="post" class="search-bar">
                <div class="input-and-button-container">
                    <div class="input-container">
                        <i class="fas fa-search"></i>
                        <input name="name-search" type="text" class="name-search" placeholder="Wpisz tytuł lub kategorię">
                    </div>
                    <button type="submit" class="button-36">Szukaj</button>
                </div>
                <div class="filter-icon-container">
                    <button id="filter-icon" class="filter-button glyphicon glyphicon-filter"> Filtry</button>
                    <button id="close" class="filter-button glyphicon glyphicon-remove"> Ukryj</button>
                </div>
                <div class="filters-container">
                    Miasto:
                    <input name="city" type="text" class="city-input" placeholder="Miasto">
                    Rozmiar:
                    <input name="size" type="text" class="size-input" placeholder="Rozmiar">
                    Cena od:
                    <input name="price-min" type="number" step="0.01" class="price-min-input" placeholder="Min">
                    do:
                    <input name="price-max" type="number" step="0.01" class="price-max-input" placeholder="Max">
                </div>
            </form>
        </div>
        <div class="category-container">
                <div class="text">
                    Kategorie
                </div>
            <div class="messages">
                <?php if(isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <form method='get' action="category" class="categories">
                <button name="category" value="buty" id="buty" class="category">
                    <img alt="shoes" class="category-img" src="public/img/uploads/shoes_2.jpg">
                    Buty
                </button>
                <button name="category" value="koszulki" id="koszulki" class="category">
                    <img alt="tshorts" class="category-img" src="public/img/uploads/graphic-tshirt-trendy-design-mockup-presented-wooden-hanger.jpg">
                    Koszulki
                </button>
                <button name="category" value="bluzy" id="bluzy" class="category">
                    <img alt="hoodies" class="category-img" src="public/img/uploads/hoody.jpg">
                    Bluzy
                </button>
                <button name="category" value="kurtki" id="kurtki" class="category">
                    <img alt="jackets" class="category-img" src="public/img/uploads/jacket.jpg">
                    Kurtki
                </button>
                <button name="category" value="akcesoria" id="akcesoria" class="category">
                    <img alt="caps" class="category-img" src="public/img/uploads/cap.jpg">
                    Akcesoria
                </button>
                <button formmethod="get" formaction="roulette" id="ruletka" class="category">
                    <img alt="roulette" class="category-img" src="public/img/uploads/random.jpg">
                    Ruletka
                </button>
            </form>
        </div>
        <?php include('footer.php') ?>
    </div>
</body>
</html>