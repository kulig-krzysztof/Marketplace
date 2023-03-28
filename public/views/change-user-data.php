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
    <?php include('search-bar.php'); ?>
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
                <h3>Name</h3>
                <input type="text" name="name">
                <h3>Surname</h3>
                <input type="text" name="surname">
                <h3>Password</h3>
                <input type="password" name="password">
                <h3>Repeat password</h3>
                <input type="password" name="repeatPassword">
                <input type="submit" value="Update" class="update-button button-36" id="button-36">
            </form>
        </div>
    </div>
    <?php include('footer.php') ?>
</div>
</body>
</html>
