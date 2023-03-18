<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/archive-items.css">
    <link rel="stylesheet" type="text/css" href="public/css/item-display.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Archive items</title>
</head>
<div class="base-container">
    <?php include('header.php') ?>
    <?php include('search-bar.php'); ?>
</div>
<div class="category-container">
    <div class="user-items">
        <h1>User archive items</h1>
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
        <form id="form" action="inactiveItemData" method="post" class="categories">
            <?php foreach ($inactiveArticles as $inactiveArticle): ?>
                <button type="submit" name="item-id" value="<?= $inactiveArticle->getId(); ?>" id="<?= $inactiveArticle->getId(); ?>">
                    <img alt="Item image" src="public/img/form-images/<?= $inactiveArticle->getImg(); ?>">
                    <div>
                        <h2><?= $inactiveArticle->getTitle(); ?></h2>
                        <p><?= "Cena: ".$inactiveArticle->getPrice()." zł"; ?></p>
                        <p><?= "Lokalizacja: ".$inactiveArticle->getLocation(); ?></p>
                    </div>
                </button>
            <?php endforeach; ?>
        </form>
    </div>
</div>
<?php include('footer.php') ?>
</body>
</html>
