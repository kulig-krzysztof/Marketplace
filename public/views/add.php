<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/add.css">
    <script type="text/javascript" src="public/js/add.js" defer></script>
    <script src="https://kit.fontawesome.com/35aaad20fa.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.js"></script>
    <title>Dodaj ogłoszenie</title>
</head>
<body>
    <div class="container">
        <?php include('header.php') ?>
        <div class="title">
            Dodaj ogłoszenie
        </div>
        <div class="form-container">
            <!-- multistep form -->
            <form id="msform" method="post" action="add" enctype="multipart/form-data">
                <!-- progressbar -->
                <ul id="progressbar">
                    <li class="active">Dane ogłoszenia</li>
                    <li>Dane produktu</li>
                    <li>Lokalizacja</li>
                    <li>Dodaj zdjęcie</li>
                </ul>
                <!-- fieldsets -->
                <fieldset>
                    <h2 class="fs-title">Dane ogłoszenia</h2>
                    <input name="title" type="text" class="title-input" placeholder="Tytuł ogłoszenia" required>
                    <select name="category" class="category-select" required>
                        <option name="category" value="" disabled selected hidden>Kategoria</option>
                        <option name="category" value="Buty">Buty</option>
                        <option name="category" value="Kurtki">Kurtki</option>
                        <option name="category" value="Koszulki">Koszulki</option>
                        <option name="category" value="Bluzy">Bluzy</option>
                        <option name="category" value="Akcesoria">Akcesoria</option>
                    </select>
                    <textarea name="desc" class="desc-input" required></textarea>
                    <input type="button" name="next" class="next button-36" value="Dalej" />
                </fieldset>
                <fieldset>
                    <h2 class="fs-title">Dane produktu</h2>
                    <input name="price" type="number" class="price" placeholder="Cena" step=".01" required>
                    <input name="size" type="text" class="size" placeholder="Rozmiar" required>
                    <select name="state" required>
                        <option name="category" value="" disabled selected hidden>Stan produktu</option>
                        <option name="state" value="false">Używany</option>
                        <option name="state" value="true">Nowy</option>
                    </select>
                    <input type="button" name="previous" class="previous button-36" value="Wróć" />
                    <input type="button" name="next" class="next button-36" value="Dalej" />
                </fieldset>
                <fieldset id="map-fieldset">
                    <h2 class="fs-title">Lokalizacja</h2>
                    <input name="city-name" type="text" class="city-name" placeholder="Lokalizacja (miasto)" required>
                    <section>
                        <div id="map" class="mapboxgl-map"></div>
                        <input id="lng" type="text" name="lng">
                        <input id="lat" type="text" name="lat">
                    </section>
                    <input type="button" name="previous" class="previous button-36" value="Wróć" />
                    <input type="button" name="next" class="next button-36" value="Dalej" />
                </fieldset>
                <fieldset id="photo-fieldset">
                    <h2 class="fs-title">Dodaj zdjęcie</h2>
                    <div id="photo-upload">
                        <i class="fas fa-camera fa-5x" id="photo-icon"></i>
                        <div class="preview">
                            <img id="file-ip-1-preview">
                        </div>
                        <input name="file" type="file" id="file-input" accept="image/*" onchange="showPreview(event);" required>
                    </div>
                    <input type="button" name="previous" class="previous button-36" value="Wróć" />
                    <input type="submit" name="next" class="button-36" value="Dodaj" />
                </fieldset>
            </form>
        </div>
        <?php include('footer.php') ?>
    </div>
</body>
</html>