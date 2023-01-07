<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/change-user-data.css">
    <script type="text/javascript" src="../../public/js/change-user-data.js" defer></script>
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
    <div class="data-container">
        <div class="user-data">
            <h1>User Data</h1>
        </div>
        <div class="user-info">
            <div class="messages">
                <?php if(isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <form class="data-form" action="updateUserData" method="post">
                <h2>Name</h2>
                <input type="text" name="name">
                <h2>Surname</h2>
                <input type="text" name="surname">
                <h2>Password</h2>
                <input type="password" name="password">
                <h2>Repeat password</h2>
                <input type="password" name="repeatPassword">
                <input type="submit" value="Update" class="update-button">
            </form>
        </div>
    </div>
    <?php include('footer.php') ?>
</div>
</body>
</html>
