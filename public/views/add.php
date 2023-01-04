<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/add.css">
    <script type="text/javascript" src="public/js/add.js" defer></script>
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj ogłoszenie</title>
</head>
<body>
    <div class="container">
        <?php include('header.php') ?>
        <div class="title">
            Dodaj ogłoszenie
        </div>
        <div class="form-container">
            <form action="add" method="post" enctype="multipart/form-data">
            <div class="left-panel">
                <div id="base-data" class="left-panel-comp">
                    Podstawowe dane:
                    <input name="title" type="text" class="title-input" placeholder="Tytuł ogłoszenia">
                    <select name="category" class="category-select">
                        <option name="category" value="" disabled selected hidden>Kategoria</option>
                        <option name="category" value="Buty">Buty</option>
                        <option name="category" value="Kurtki">Kurtki</option>
                        <option name="category" value="Koszulki">Koszulki</option>
                        <option name="category" value="Bluzy">Bluzy</option>
                        <option name="category" value="Akcesoria">Akcesoria</option>
                    </select>
                </div>
                
                <div id="description" class="left-panel-comp">
                    Opis ogłoszenia:
                    <textarea name="desc" class="desc-input"></textarea>
                </div>
                
                <div id="data" class="left-panel-comp">
                    Dane ogłoszenia:
                    <div class="data-input">
                    <input name="phone" type="tel" class="number" placeholder="Nr telefonu">
                    <input name="price" type="number" class="price" placeholder="Cena">
                    <input name="email" type="email" class="mail" placeholder="Adres email">
                    </div>
                </div>
            </div>
            <div class="right-panel">
                <div id="location" class="right-panel-comp">
                    Lokalizacja
                    <input type="text" name="location" class="map" placeholder="Wpisz lokalizację">
                </div>
                <div id="photo-upload" class="right-panel-comp">
                    <i class="fas fa-camera fa-5x"></i>
                    <input name="file" type="file" required>
                </div>
                <button type="submit" id="add" class="right-panel-comp">
                    Dodaj
                </button>
            </div>
            </form>
        </div>
        <?php include('footer.php') ?>
    </div>
</body>
</html>