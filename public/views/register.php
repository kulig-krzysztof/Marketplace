<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/register.css">
    <script type="text/javascript" src="public/js/script.js" defer></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel rejestracji</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img class="logo-img" src="public/img/logo.svg">
    </div>
    <div class="register-container">
        <form class="register" action="register" method="post" enctype="multipart/form-data">
            <div class="messages">
                <?php if(isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <input id="email" name="email" type="text" placeholder="Email@email.com">
            <input id="password" name="password" type="password" placeholder="Hasło">
            <input name="name" type="text" placeholder="Imię">
            <input name="surname" type="text" placeholder="Nazwisko">
            <button type="submit">SIGN UP</button>
        </form>
    </div>
</div>
</body>
</html>