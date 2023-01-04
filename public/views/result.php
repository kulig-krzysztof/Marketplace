<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/results.css">
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki wyszukiwania</title>
</head>
<body>
<div class="base-container">
    <?php include('header.php'); ?>
    <div class="search">
        <div class="form" class="search-bar">
            <div class="input-container">
                <i class="fas fa-search"></i>
                <input name="name-search" type="text" class="name-search" placeholder="Czego szukasz?">
            </div>
            <div class="input-container">
                <i class="fas fa-thumbtack"></i>
                <input type="text" class="location" placeholder="Lokalizacja">
            </div>
            <button type="submit" class="search-button">Szukaj</button>
        </div>
    </div>
    <div class="category-container">
        <form id="form" action="item" method="post" class="categories">
            <?php foreach ($articles as $article): ?>
            <button type="submit" name="item-id" value="<?= $article->getId(); ?>" id="<?= $article->getId(); ?>">
                <img src="public/img/form-images/<?= $article->getImg(); ?>">
                <div>
                    <h2><?= $article->getTitle(); ?></h2>
                    <p><?= "Cena: ".$article->getPrice()." zł"; ?></p>
                    <p><?= "Lokalizacja: ".$article->getLocation(); ?></p>
                </div>
            </button>
            <?php endforeach; ?>
        </form>
    </div>
    <?php include('footer.php'); ?>
</div>

</body>
<template id="template">
<button type="submit" name="item-id" value="" id="">
    <img src="">
    <div>
        <h2>title</h2>
        <p id="price">Cena: </p>
        <p id="location">Lokalizacja: </p>
    </div>
</button>
</template>
</html>