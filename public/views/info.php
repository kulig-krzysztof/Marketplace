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
            <button type="submit" class="button-36">Szukaj</button>
        </form>
    </div>
    <div class="messages">
        <?php if(isset($messages)) {
            foreach ($messages as $message) {
                echo $message;
            }
        }
        ?>
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
        <form class="update-form" action="updateDataSite" method="post">
            <button class="button-36" type="submit" name="update" value="Update">Update</button>
        </form>
    </div>
    <div class="user-items">
        <h1>User active items</h1>
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
    <div class="user-items">
        <h1>User archive items</h1>
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
    <div class="user-items">
        <h1>Bidded Items</h1>
    </div>
    <div class="items-container">
        <form id="form" action="biddedItemData" method="post" class="categories">
            <?php foreach ($biddedArticles as $biddedArticle): ?>
                <button type="submit" name="item-id" value="<?= $biddedArticle->getId(); ?>" id="<?= $biddedArticle->getId(); ?>">
                    <img alt="Item image" src="public/img/form-images/<?= $biddedArticle->getImg(); ?>">
                    <div>
                        <h2><?= $biddedArticle->getTitle(); ?></h2>
                        <p><?= "Cena: ".$biddedArticle->getPrice()." zł"; ?></p>
                        <p><?= "Lokalizacja: ".$biddedArticle->getLocation(); ?></p>
                    </div>
                </button>
            <?php endforeach; ?>
        </form>
    </div>
    <div class="user-items">
        <h1>Bought Items</h1>
    </div>
    <div class="items-container">
        <form id="form" action="boughtItemData" method="post" class="categories">
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
    <?php include('footer.php') ?>
</div>
</body>
</html>
