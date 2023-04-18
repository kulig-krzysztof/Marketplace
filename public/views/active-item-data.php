<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/active-item-data.css">
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
                            <button class="button-36" type="submit" name="item-id" value="<?= $articles->getId();?>">Aktualizuj</button>
                        </form>
                        <form action="showOffersForItem" method="get" id="offers-form">
                            <button class="button-36" type="submit" name="item-id" value="<?= $articles->getId();?>">Pokaż oferty</button>
                        </form>
                    </div>
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
                    <div id="user-email"><?= $articles->getEmail(); ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</div>
</body>
