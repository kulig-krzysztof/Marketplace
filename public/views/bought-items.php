<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/bought-items.css">
    <link rel="stylesheet" type="text/css" href="public/css/item-display.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zakupione przedmioty</title>
</head>
<div class="base-container">
    <?php include('header.php') ?>
    <?php include('search-bar.php'); ?>
</div>
<div class="category-container">
    <div class="user-items">
        <h1>Twoje zakupione przedmioty</h1>
    </div>
    <div class="messages">
        <?php if(isset($messages)) {
            foreach ($messages as $message) {
                echo $message;
            }
        }
        ?>
    </div>
    <div class="items-container">
        <form id="form" action="boughtItemData" method="get" class="categories">
            <?php foreach ($boughtArticles as $boughtArticle): ?>
                <button type="submit" name="item-id" value="<?= $boughtArticle->getId(); ?>" id="<?= $boughtArticle->getId(); ?>">
                    <img alt="Item image" src="public/img/form-images/<?= $boughtArticle->getImg(); ?>">
                    <div>
                        <h2><?= $boughtArticle->getTitle(); ?></h2>
                        <p><?= "Cena: ".$boughtArticle->getPrice()." zł"; ?></p>
                        <p><?= "Lokalizacja: ".$boughtArticle->getLocation(); ?></p>
                    </div>
                </button>
            <?php endforeach; ?>
        </form>
    </div>
</div>
<?php include('footer.php') ?>
</body>
</html>
