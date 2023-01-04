<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyszukaj</title>
</head>
<body>
    <div class="header">
        <?= session_start() ?>
        <a href="actions"><img class="logo-img" src="public/img/logo.svg"></a>
        <div class="buttons">
            <form class="logout_form" method="POST" action="info" class="account">
                <input class="logout" type="submit" name="User" value="User">
            </form>
            <form class="logout_form" method="POST" action="logout" class="account">
                <input class="logout" type="submit" name="Logout" value="Logout">
            </form>
        </div>
    </div>
</body>
</html>