<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../public/js/header.js" defer></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyszukaj</title>
</head>
<body>
    <div class="header">
        <a href="actions"><img alt="Grance" class="logo-img" src="public/img/logo.svg"></a>
            <div class="menu">
                <img class="menu-img" src="../../public/img/menu.svg" alt="menu">
            </div>
            <div id="menu" style="display: none;">
                <form class="menu-component" method="POST" action="info" class="account">
                    <input class="button" type="submit" name="User" value="User">
                </form>
                <form class="menu-component" id="logout" method="POST" action="logout" class="account">
                    <input class="button" type="submit" name="Logout" value="Logout">
                </form>
            </div>
    </div>
</body>
</html>