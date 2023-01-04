<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/item.css">
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $articles->getTitle(); ?></title>
</head>
<body>
<div class="base-container">
    <?php include('header.php'); session_start(); ?>
    <div class="search">
        <form class="form" class="search-bar" method="post" action="results">
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
            <h1>Dane ogłoszenia</h1>
        </div>
        <div class="img-and-price-container">
            <img alt="Item Image" src="public/img/form-images/<?= $articles->getImg(); ?>">
            <div class="item-information">
                <h2>Tytuł ogłoszenia:</h2>
                <h3><?= $articles->getTitle(); ?></h3>
                <h2>Cena:</h2>
                <h3><?= $articles->getPrice(); ?> zł</h3>
                <form action="" method="post">
                    <input type="number" name="bid-value" placeholder="How much would you like to bid?" class="bid-value">
                    <input type="submit" name="bid" value="Bid" class="bid-button">
                </form>
            </div>
        </div>
        <hr />
        <div class="description-and-user-info">
            <div class="description">
                <h2>Description:</h2>
                <h2 id="description-h2"><?= $articles->getDescription(); ?></h2>
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