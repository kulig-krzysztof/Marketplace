<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/admin-info.css">
    <link rel="stylesheet" type="text/css" href="public/css/item-display.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dane użytkownika - administrator</title>
</head>
<body>
<div class="base-container">
    <?php include('header.php') ?>
    <?php include('search-bar.php'); ?>
    <div class="category-container">
        <div class="messages">
            <?php if(isset($messages)) {
                foreach ($messages as $message) {
                    echo $message;
                }
            }
            ?>
        </div>
        <div class="user-data">
            <h1>Dane użytkownika</h1>
        </div>
        <div class="user-info">
            <h3>Imię</h3>
            <div class="container"><?= $user->getName(); ?></div>
            <h3>Nazwisko</h3>
            <div class="container"><?= $user->getSurname(); ?></div>
            <h3>Adres e-mail</h3>
            <div class="container"><?= $user->getEmail(); ?></div>
            <div class="form-container">
                <form class="update-form" action="updateDataSite" method="get">
                    <button class="button-36" type="submit" name="update" value="Update">Zmień</button>
                </form>
                <form class="admin" action="admin" method="get">
                    <button class="button-36" type="submit">Panel Administratora</button>
                </form>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</div>
</body>
</html>
