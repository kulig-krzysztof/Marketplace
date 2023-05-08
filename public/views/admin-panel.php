<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/admin-panel.css">
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki wyszukiwania</title>
</head>
<body>
<div class="base-container">
    <?php include('header.php'); ?>
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
        <table class="users-table">
            <tr class="first-row">
                <td class="td-email">Email</td>
                <td class="td-name">Imię</td>
                <td class="td-surname">Nazwisko</td>
                <td class="td-type">Rodzaj konta</td>
                <td class="td-button">Pokaż profil</td>
                <td class="td-button">Usuń użytkownika</td>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr class="rows">
                    <td class="td-email"><?= $user->getEmail(); ?></td>
                    <td class="td-name"><?= $user->getName(); ?></td>
                    <td class="td-surname"><?= $user->getSurname(); ?></td>
                    <td class="td-type"><?= $user->getAccountType() == 1 ? "Użytkownik" : "Administrator"; ?></td>
                    <td class="td-button">
                        <form class="form-buttons" action="userProfile" method="get">
                            <button class="submit-button" type="submit" name="user-email" value="<?= $user->getEmail(); ?>"><i class="glyphicon glyphicon-user"></i> Profil</button>
                        </form>
                    </td>
                    <td class="td-button">
                        <form class="form-buttons" action="deleteUser" method="post">
                            <button class="submit-button" type="submit" name="user-email" value="<?= $user->getEmail(); ?>"><i class="glyphicon glyphicon-remove"></i> Usuń</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php include('footer.php'); ?>
</div>

</body>
<template id="template">
    <button type="submit" name="item-id" value="" id="">
        <img alt="" src="">
        <div>
            <h2>title</h2>
            <p id="price">Cena: </p>
            <p id="location">Lokalizacja: </p>
        </div>
    </button>
</template>
</html>