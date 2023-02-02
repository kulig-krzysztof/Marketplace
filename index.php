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
Routing::get('registerPage', 'DefaultController');
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
Routing::get('allOffersForItem', 'OfferController');
Routing::post('acceptOffer', 'OfferController');
Routing::post('inactiveItemData', 'AddController');
Routing::post('biddedItemData', 'AddController');
Routing::post('declineOffer', 'OfferController');
Routing::post('respondToOffer', 'OfferController');
Routing::get('respondTo', 'OfferController');
Routing::post('respond', 'OfferController');
Routing::get('offersOfBidder', 'OfferController');
Routing::get('counterOffer', 'OfferController');
Routing::post('boughtItemData', 'AddController');
Routing::get('formTest', 'DefaultController');
Routing::run($path);