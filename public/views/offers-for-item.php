<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/offers-for-item.css">
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/offers-for-item.js" defer></script>
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
    <div class="main-container">
        <div class="offers-container">
            <section>
                <div id="map2" class="mapboxgl-map"></div>
            </section>
        </div>
        <div class="category-container">
            <h2>Oferty dla ogłoszenia</h2>
            <h3>Tytuł ogłoszenia:</h3>
            <div id="title" class="info-container"><?= $articles->getTitle(); ?></div>
            <h3>Cena:</h3>
            <div id="price" class="info-container"><?= $articles->getPrice(); ?></div>
            <h3>Stan:</h3>
            <div id="state" class="info-container"><?= $articles->getStateString(); ?></div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>
