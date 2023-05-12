<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/search-bar.css">
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../public/js/header.js" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyszukaj</title>
</head>
<body>
    <div class="search">
        <form action="results" method="post" class="search-bar">
            <div class="input-and-button-container">
                <div class="input-container">
                    <i class="fas fa-search"></i>
                    <input name="name-search" type="text" class="name-search" placeholder="Wpisz tytuł lub kategorię">
                </div>
                <button type="submit" class="button-search">Szukaj</button>
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
</body>
</html>
