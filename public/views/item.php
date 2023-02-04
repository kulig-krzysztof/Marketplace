<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/item.css">
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
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
        <div class="text">
            <h1>Dane ogłoszenia</h1>
        </div>
        <div class="img-and-price-container">
            <img alt="Item Image" src="public/img/form-images/<?= $articles->getImg(); ?>">
            <div class="item-information">
                <h2>Tytuł ogłoszenia:</h2>
                <h3><?= $articles->getTitle(); ?></h3>
                <h2>Cena:</h2>
                <h3><?= $articles->getPrice(); ?> zł</h3>
                <h2>Stan:</h2>
                <h3><?= $articles->getStateString(); ?></h3>
                <form action="bid" method="post">
                    <div class="messages">
                        <?php if(isset($messages)) {
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <input type="text" name="location" placeholder="What city do you offer? (required)" required>
                    <input type="number" step="0.01" name="bid-value" placeholder="How much would you like to bid?" class="bid-value" required>
                    <input type="datetime-local" id="meeting-time" name="meeting-time" required>
                    <section>
                        <h1>Choose exact location on the map</h1>
                        <div id="map" class="mapboxgl-map"></div>
                        <input id="lng" type="text" name="lng" hidden required>
                        <input id="lat" type="text" name="lat" hidden required>
                    </section>
                    <input type="submit" name="bid" value="Bid" class="bid-button">
                </form>
            </div>
        </div>
        <hr />
        <div class="description-and-user-info">
            <div class="description">
                <h2>Description:</h2>
                <div id="description-h2"><?= str_replace("\n", "<br>", $articles->getDescription()); ?></div>
            </div>
            <div class="user">
                <h2>Posted by user</h2>
                <h2><?= $articles->getEmail(); ?></h2>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>