<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/active-item-data.css">
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/offers-for-item.js" defer></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $articles->getTitle(); ?></title>
</head>
<body>
<div class="base-container">
    <?php include('header.php'); session_start(); ?>
    <?php include('search-bar.php'); ?>
    <div class="category-container">
        <div class="main-container">
            <div class="text">
                <h1>Dane ogłoszenia</h1>
            </div>
            <div class="img-and-price-container">
                <img alt="Item Image" src="public/img/form-images/<?= $articles->getImg(); ?>">
                <div class="item-information">
                    <h2>Tytuł ogłoszenia:</h2>
                    <div id="title" class="info-container"><?= $articles->getTitle(); ?></div>
                    <h2>Cena:</h2>
                    <div id="price" class="info-container"><?= $articles->getPrice(); ?></div>
                    <h2>Stan:</h2>
                    <div id="state" class="info-container"><?= $articles->getStateString(); ?></div>
                    <div id="buttons-container">
                        <form action="updateItemSite" method="get" id="update-form">
                            <button class="button-36 action-button" type="submit" name="item-id" value="<?= $articles->getId();?>">Aktualizuj</button>
                        </form>
                        <form action="deleteItem" method="get" id="delete-form">
                            <button class="button-36 action-button" type="submit" name="item-id" value="<?= $articles->getId();?>">Usuń ogłoszenie</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="map-and-description-container">
                <div class="meeting-information-container">
                    <h2>Oferty:</h2>
                    <section>
                        <div id="map2" class="mapboxgl-map"></div>
                    </section>
                </div>
                <div class="bid-form-container">
                    <h2>Dodaj ofertę</h2>
                    <form class="bid-form" method="post" action="respond">
                        <span id="close">X</span>
                        <h2>Podaj miasto, w którym proponujesz spotkanie:</h2>
                        <input id="input-city" class="bid-input" type="text" name="location" placeholder="Podaj miasto" required>
                        <h2>Podaj cenę, którą proponujesz: (Aktualnie najwyższa oferta to <?= $currentHighestBid; ?> zł)</h2>
                        <input id="input-bid" class="bid-input" type="number" step="0.01" min="<?= $currentHighestBid ?>" name="bid-value" placeholder="Podaj proponowaną kwotę" required>
                        <h2>Podaj datę i godzinę spotkania:</h2>
                        <input class="bid-input" type="datetime-local" id="meeting-time" name="meeting-time" required>
                        <input type="text" name="lng" id="lng" hidden required>
                        <input type="text" name="lat" id="lat" hidden required>
                        <input id="input-id" type="text" name="id" hidden>
                        <input type="submit" id="bid-submit" class="button-36" name="bid" value="Złóż ofertę">
                    </form>
                </div>
                <div class="description-and-user-info">
                    <div class="description">
                        <h2>Opis:</h2>
                        <div id="description-h2"><?= str_replace("\n", "<br>", $articles->getDescription()); ?></div>
                    </div>
                </div>
            </div>
            <div class="user">
                <h2>Posted by user</h2>
                <form class="user-data-form" action="userProfile" method="get">
                    <button id="user-email" type="submit" name="user-email" value="<?= $articles->getEmail(); ?>"><?= $articles->getEmail(); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
    <?php include('footer.php'); ?>
</body>
</html>
