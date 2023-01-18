<?php

require 'routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('index', 'DefaultController');
Routing::get('logout', 'SecurityController');
Routing::get('actions', 'DefaultController');
Routing::get('categories', 'DefaultController');
Routing::get('add', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('results', 'AddController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'AddUserController');
Routing::post('add', 'AddController');
Routing::post('search', 'AddController');
Routing::post('category', 'AddController');
Routing::post('item', 'AddController');
Routing::post('info', 'SecurityController');
Routing::post('updateUserData', 'SecurityController');
Routing::post('updateDataSite', 'DefaultController');
Routing::post('updateItemData', 'AddController');
Routing::post('updateItemSite', 'AddController');
Routing::post('bid', 'OfferController');
Routing::get('map', 'MapController');
Routing::get('offers', 'OfferController');
Routing::post('acceptOffer', 'OfferController');
Routing::run($path);