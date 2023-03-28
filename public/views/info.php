<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/info.css">
    <link rel="stylesheet" type="text/css" href="public/css/item-display.css">
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
        <h1>User Data</h1>
    </div>
    <div class="user-info">
        <h3>Name</h3>
        <div><?= $user->getName(); ?></div>
        <h3>Surname</h3>
        <div><?= $user->getSurname(); ?></div>
        <h3>Email</h3>
        <div><?= $user->getEmail(); ?></div>
        <form class="update-form" action="updateDataSite" method="post">
            <button class="button-36" type="submit" name="update" value="Update">Update</button>
        </form>
    </div>
</div>
    <?php include('footer.php'); ?>
</div>
</body>
</html>
