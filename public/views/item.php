<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/item.css">
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/item.js" defer></script>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
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
                <div class="description-and-user-info">
                    <div class="description">
                        <h2>Description:</h2>
                        <div id="description-h2"><?= str_replace("\n", "<br>", $articles->getDescription()); ?></div>
                    </div>
                </div>
            </div>
            <div class="user">
                <h2>Posted by user</h2>
                <div id="user-email"><?= $articles->getEmail(); ?></div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>