<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wybór akcji</title>
</head>
<body>
    <div class="option-container">
        <div class="title">
            Co chcesz zrobić?
        </div>
        <div class="options">
        <div id="buy-button" class="option" onclick="window.location.href='/categories'">
            <img alt="Shopping Cart" class="option-icon" src="public/img/uploads/shopping-cart.png">
            <div class="buy">
                KUPUJĘ
            </div>
        </div>
        <div id="sell-button" class="option" onclick="window.location.href='/add'">
            <img alt="Dollar Symbol" class="option-icon" src="public/img/uploads/dollar-symbol.png">
            <div class="sell">
                SPRZEDAJĘ
            </div>
        </div>
        </div>
    </div>
</body>
</html>