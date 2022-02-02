<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/add.css">
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj ogłoszenie</title>
</head>
<body>
    <div class="container">
        <header>
            <img class="logo-img" src="public/img/logo.svg">
            <button class="account">
                Konto
                <i class="fas fa-user"></i>
            </button>
        </header>
        <div class="title">
            Dodaj ogłoszenie
        </div>
        <div class="form-container">
            <form>
            <div class="left-panel">
                <div id="base-data" class="left-panel-comp">
                    Podstawowe dane:
                    <input type="text" class="title-input" placeholder="Tytuł ogłoszenia">
                    <select class="category-select">
                        <option value="" disabled selected hidden>Kategoria</option>
                    </select>
                </div>
                
                <div id="description" class="left-panel-comp">
                    Opis ogłoszenia:
                    <textarea class="desc-input"></textarea>
                </div>
                
                <div id="data" class="left-panel-comp">
                    Dane ogłoszenia:
                    <div class="data-input">
                    <input type="tel" class="number" placeholder="Nr telefonu">
                    <input type="number" class="price" placeholder="Cena">
                    <input type="email" class="mail" placeholder="Adres email">
                    </div>
                </div>
            </div>
            <div class="right-panel">
                <div id="location-map" class="right-panel-comp">
                    Lokalizacja
                    <div class="map">
                    </div>
                </div>
            <div class="img-add">
                <div id="photo-upload" class="right-panel-comp">
                    <i class="fas fa-camera fa-5x"></i>
                    <input type="file">
                </div>
                <button id="add" class="right-panel-comp">
                    Dodaj
                </button>
            </div>
            </div>
            </form>
        </div>
        <footer>
            <div>@ 2022 Krzysztof Kulig</div>
            <div>
                <i class="fab fa-facebook"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-github"></i>
            </div>
        </footer>
    </div>
</body>
</html>