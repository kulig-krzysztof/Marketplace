<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/info.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User information</title>
</head>
<body>
<div class="base-container">
    <?php include('header.php') ?>
    <div class="search">
        <form action="results" method="post" class="search-bar">
            <div class="input-container">
                <i class="fas fa-search"></i>
                <input name="name-search" type="text" class="name-search" placeholder="Wpisz tytuł lub kategrię">
            </div>
            <div class="input-container">
                <i class="fas fa-thumbtack"></i>
                <input type="text" class="location" placeholder="Lokalizacja">
            </div>
            <button type="submit" class="search-button">Szukaj</button>
        </form>
    </div>
    <div class="user-data">
        <h1>User Data</h1>
    </div>
    <div class="user-info">
        <h2>Name</h2>
        <h3><?= $user->getName(); ?></h3>
        <h2>Surname</h2>
        <h3><?= $user->getSurname(); ?></h3>
        <h2>Email</h2>
        <h3><?= $user->getEmail(); ?></h3>
        <form class="update-form" action="info" method="post">
            <button class="update-button" type="submit" name="update" value="Update">Update</button>
        </form>
    </div>
    <div class="user-items">
        <h1>User items</h1>
    </div>
    <div class="items-container">
        <form id="form" action="item" method="post" class="categories">
            <?php foreach ($articles as $article): ?>
                <button type="submit" name="item-id" value="<?= $article->getId(); ?>" id="<?= $article->getId(); ?>">
                    <img alt="Item image" src="public/img/form-images/<?= $article->getImg(); ?>">
                    <div>
                        <h2><?= $article->getTitle(); ?></h2>
                        <p><?= "Cena: ".$article->getPrice()." zł"; ?></p>
                        <p><?= "Lokalizacja: ".$article->getLocation(); ?></p>
                    </div>
                </button>
            <?php endforeach; ?>
        </form>
    </div>
    <?php include('footer.php') ?>
</div>
</body>
</html>
