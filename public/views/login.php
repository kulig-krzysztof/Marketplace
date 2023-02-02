<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../../public/css/login.css">
    <script type="text/javascript" src="../../public/js/script.js" defer></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel logowania</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img class="logo-img" src="../../public/img/logo.svg" alt="logo">
        </div>
        <div class="login-container">
            <form class="login" action="login" method="post">
                <div class="messages">
                    <?php
                    if(isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    } ?>
                </div>
                    <input id="email" name="email" type="text" placeholder="Email@email.com">
                    <input name="password" type="password" placeholder="Hasło">
                <button id="login-button" class="button-36" type="submit">LOG IN</button>
                <button class="button-36" type="button" id="register" onclick="window.location.href='/registerPage'">SIGN UP</button>
            </form>
        </div>
    </div>
</body>
</html>