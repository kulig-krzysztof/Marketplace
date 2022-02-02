<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel logowania</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img class="logo-img" src="public/img/logo.svg">
        </div>
        <div class="login-container">
            <form class="login" action="login" method="post">
                <div class="messages">
                    <?php if(isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="email" type="text" placeholder="Email@email.com">
                <input name="password" type="password" placeholder="Hasło">
                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</body>
</html>