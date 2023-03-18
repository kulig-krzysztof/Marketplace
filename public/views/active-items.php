<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/active-items.css">
    <link rel="stylesheet" type="text/css" href="public/css/item-display.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Active items</title>
</head>
<div class="base-container">
    <?php include('header.php') ?>
    <?php include('search-bar.php'); ?>
<div class="category-container">
    <div class="user-items">
        <h1>User active items</h1>
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
        <form id="form" action="updateItemSite" method="post" class="categories">
            <?php foreach ($activeArticles as $activeArticle): ?>
                <button type="submit" name="item-id" value="<?= $activeArticle->getId(); ?>" id="<?= $activeArticle->getId(); ?>">
                    <img alt="Item image" src="public/img/form-images/<?= $activeArticle->getImg(); ?>">
                    <div>
                        <h2><?= $activeArticle->getTitle(); ?></h2>
                        <p><?= "Cena: ".$activeArticle->getPrice()." zł"; ?></p>
                        <p><?= "Lokalizacja: ".$activeArticle->getLocation(); ?></p>
                    </div>
                </button>
            <?php endforeach; ?>
        </form>
    </div>
</div>
</div>
<?php include('footer.php') ?>
</body>
</html>
