<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/change-item-data.css">
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/change-item-data.js" defer></script>
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
            </div>
        </div>
        <hr />
        <div class="description-and-user-info">
            <div class="description">
                <h2>Description:</h2>
                <h2 id="description-h2"><?= str_replace("\n", "<br>", $articles->getDescription()); ?></h2>
            </div>
            <div class="user">
                <h2>Posted by user</h2>
                <h2><?= $articles->getEmail(); ?></h2>
            </div>
        </div>
    </div>
    <div class="update-form-containter">
        <div class="title">
            Podaj dane do zmiany
        </div>
        <div class="form-container">
            <form id="form" action="updateItemData" method="post" enctype="multipart/form-data">
                <div class="left-panel">
                    <div id="base-data" class="left-panel-comp">
                        Podstawowe dane:
                        <input name="title" type="text" class="title-input" value="<?= $articles->getTitle(); ?>">
                        <select name="category" class="category-select">
                            <option name="category" value="<?= $articles->getCategory(); ?>" selected hidden><?= $articles->getCategory(); ?></option>
                            <option name="category" value="Buty">Buty</option>
                            <option name="category" value="Kurtki">Kurtki</option>
                            <option name="category" value="Koszulki">Koszulki</option>
                            <option name="category" value="Bluzy">Bluzy</option>
                            <option name="category" value="Akcesoria">Akcesoria</option>
                        </select>
                    </div>

                    <div id="description" class="left-panel-comp">
                        Opis ogłoszenia:
                        <textarea name="desc" class="desc-input"><?= $articles->getDescription(); ?></textarea>
                    </div>

                    <div id="data" class="left-panel-comp">
                        Dane ogłoszenia:
                        <div class="data-input">
                            <input name="price" type="number" class="price" placeholder="Cena" value="<?= $articles->getPrice(); ?>" step="0.01">
                            <input name="city-name" type="text" class="city-name" placeholder="Lokalizacja (miasto)" value="<?= $articles->getLocation(); ?>">
                            <input name="size" type="text" class="size" placeholder="Rozmiar" value="<?= $articles->getSize(); ?>">
                            <select name="state">
                                <option name="state" value="<?= $articles->getState(); ?>" selected hidden><?= $articles->getStateString(); ?></option>
                                <option name="state" value="false">Używany</option>
                                <option name="state" value="true">Nowy</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="right-panel">
                    <section>
                        <div id="map" class="mapboxgl-map"></div>
                        <input id="lng" type="text" name="lng" hidden>
                        <input id="lat" type="text" name="lat" hidden>
                    </section>
                    <div id="photo-upload" class="right-panel-comp">
                        <i class="fas fa-camera fa-5x"></i>
                        <input name="file" type="file">
                    </div>
                    <button type="submit" id="add" class="right-panel-comp button-36">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="offers-container">
            <section>
                <div id="map2" class="mapboxgl-map"></div>
            </section>
    </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>