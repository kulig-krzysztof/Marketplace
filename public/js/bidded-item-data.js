mapboxgl.accessToken = 'pk.eyJ1Ijoia3VsaWcta3J6eXN6dG9mIiwiYSI6ImNsY3EydTJ5YzAxeHEzcXAwajJrOW1ncTgifQ.YRwmFveycWBp-xaTfTqRSQ';
const map1 = new mapboxgl.Map({
    container: 'map2', // container ID
// Choose from Mapbox's core styles, or make your own style with Mapbox Studio
    style: 'mapbox://styles/mapbox/streets-v12', // style URL
    center: [19.94498, 50.06465], // starting position [lng, lat]
    zoom: 9 // starting zoom
});

var marker = new mapboxgl.Marker();
var lng;
var lat;

function add_marker (event) {
    var coordinates = event.lngLat;
    lng = coordinates.lng;
    lat = coordinates.lat;
    console.log('Lng:', lng, 'Lat:', lat);
    marker.setLngLat(coordinates).addTo(map1);
    document.getElementById("lng").setAttribute('value', lng);
    document.getElementById("lat").setAttribute('value', lat);
}

fetch("/offersOfBidder", {
    method: "GET"
}).then(function (response) {
    //console.log(response.json());
    return response.json();
}).then(function(offersOfBidder) {
    offersOfBidder.map(offer => {
        offer.coordinates = [JSON.parse(offer.lng), JSON.parse(offer.lat)];
        offer.title = JSON.parse(offer.id)
        offer.description = JSON.parse(offer.price)
    });
    placeMarkers(offersOfBidder);
});

fetch("/counterOffer", {
    method: "GET"
}).then(function (response) {
    return response.json();
}).then(function(counterOffer) {
    counterOffer.map(offer => {
        offer.coordinates = [JSON.parse(offer.lng), JSON.parse(offer.lat)];
        offer.title = JSON.parse(offer.id)
        offer.description = JSON.parse(offer.price)
    });
    placeCounterOfferMarker(counterOffer);
});


function placeMarkers(offersOfBidder) {
    for (const feature of offersOfBidder) {
        // create a HTML element for each feature
        const el = document.createElement('div');
        el.className = 'marker';
        console.log(feature)

        // make a marker for each feature and add to the map
        new mapboxgl.Marker(el)
            .setLngLat(feature.coordinates)
            .setPopup(
                new mapboxgl.Popup({ offset: 25 }) // add popups
                    .setHTML(
                        `<h2 class="popup-h2">Twoja oferta:</h2><h3 class="popup-h3">Cena:</h3><p class="popup-p">${feature.price} zł</p><h3 class="popup-h3">Data i godzina:</h3><p class="popup-p">${feature.data}</p>
                         <form action="deleteOffer" method="get"><button class="offer-button" type="submit" name="offer-id" value="${feature.id}">Usuń</button></form>`
                    )
            )
            .addTo(map1);
    }
}

function placeCounterOfferMarker(counterOffer) {
    for (const feature of counterOffer) {
        // create a HTML element for each feature
        const el = document.createElement('div');
        el.className = 'counter-offer-marker';
        console.log(feature)

        // make a marker for each feature and add to the map
        new mapboxgl.Marker(el)
            .setLngLat(feature.coordinates)
            .setPopup(
                new mapboxgl.Popup({ offset: 25 }) // add popups
                    .setHTML(
                        `<h3 class="popup-h3">Autor:</h3><p class="popup-p" id="p-email">${feature.email}</p><h3 class="popup-h3">Cena:</h3><p id="p-price" class="popup-p">${feature.price} zł</p><h3 class="popup-h3">Data i godzina:</h3><p id="p-data" class="popup-p">${feature.data}</p><h3 class="popup-h3">Miasto:</h3><p id="p-city" class="popup-p">${feature.city_name}</p><p id="p-lng">${feature.coordinates[0]}</p><p id="p-lat">${feature.coordinates[1]}</p><p id="p-id" class="popup-p">${feature.id}</p>
                         <form method="post" action="acceptOffer"><input type="hidden" name="id" value="${feature.id}"><input class="offer-button" type="submit" name="accept" value="Accept"></form>
                         <form method="post" action="declineOffer"><input type="hidden" name="id" value="${feature.id}"><input class="offer-button" type="submit" name="decline" value="Decline"></form>
                         <div><button id="add" class="offer-button" type="button" onclick="openBidPanel()">Respond</button></div>
                        `
                    )
            )
            .addTo(map1);
    }
}

function openBidPanel() {
    document.querySelector(".description-and-user-info").classList.add("description-and-user-info-inactive");
    document.querySelector(".description-and-user-info-inactive").classList.remove("description-and-user-info");
    document.querySelector(".bid-form-container").classList.add("bid-form-container-active");
    document.querySelector(".bid-form-container-active").classList.remove("bid-form-container");
    let data = document.querySelector("#p-data").innerHTML.split(" ");
    document.querySelector("#meeting-time").setAttribute("default", data[0] + "T" + data[1]);
    document.querySelector("#input-city").setAttribute("default", document.querySelector("#p-city").innerHTML);
    document.querySelector("#input-bid").setAttribute("default", document.querySelector("#p-price").innerHTML);
    document.querySelector("#input-bid").setAttribute("placeholder", document.querySelector("#p-price").innerHTML);
    document.querySelector("#input-city").setAttribute("placeholder", document.querySelector("#p-city").innerHTML);
    document.querySelector("#input-city").setAttribute("value", document.querySelector("#p-city").innerHTML);
    document.querySelector("#input-bid").setAttribute("value", document.querySelector("#p-price").innerHTML);
    document.querySelector("#input-id").setAttribute("value", document.querySelector("#p-id").innerHTML);
    document.querySelector("#lng").setAttribute("value", document.querySelector("#p-lng").innerHTML);
    document.querySelector("#lat").setAttribute("value", document.querySelector("#p-lat").innerHTML);
    console.log(document.querySelector("#p-id").innerHTML);
}

/*
const button = document.querySelector(".offer-button");
//map2.on('click', add_marker);
button.addEventListener('click', function(event)  {
    document.querySelector(".description-and-user-info").classList.add("description-and-user-info-inactive");
    document.querySelector(".description-and-user-info-inactive").classList.remove("description-and-user-info");
    document.querySelector(".bid-form-container").classList.add("bid-form-container-active");
    document.querySelector(".bid-form-container-active").classList.remove("bid-form-container");
});
*/

map1.on('click', add_marker);

const close = document.querySelector("#close");
close.addEventListener("click", function () {
    document.querySelector(".description-and-user-info-inactive").classList.add("description-and-user-info");
    document.querySelector(".description-and-user-info").classList.remove("description-and-user-info-inactive");
    document.querySelector(".bid-form-container-active").classList.add("bid-form-container");
    document.querySelector(".bid-form-container").classList.remove("bid-form-container-active");
});

let date = new Date();
let month = date.getMonth()+1;
if (month < 10) {
    month = "0" + month;
}
let day = date.getDate();
if (day < 10) {
    day = "0" + day;
}
let hour = date.getHours();
if (hour < 10) {
    hour = "0" + hour;
}
let minutes = date.getMinutes();
if (minutes < 10) {
    minutes = "0" + minutes;
}


let currentDate = date.getFullYear() + "-" + month + "-" + day + "T" + hour + ":" + minutes;
console.log(currentDate);
document.getElementById("meeting-time").setAttribute('min', currentDate);

/*
const button = document.querySelector("#add");
map1.on('click', add_marker);
button.addEventListener('click', function(event)  {
    event.preventDefault();
    document.querySelector(".description-and-user-info").classList.add("description-and-user-info-inactive");
    document.querySelector(".description-and-user-info-inactive").classList.remove("description-and-user-info");
    document.querySelector(".bid-form-container").classList.add("bid-form-container-active");
    document.querySelector(".bid-form-container-active").classList.remove("bid-form-container");
});

const close = document.querySelector("#close");
close.addEventListener("click", function () {
    document.querySelector(".description-and-user-info-inactive").classList.add("description-and-user-info");
    document.querySelector(".description-and-user-info").classList.remove("description-and-user-info-inactive");
    document.querySelector(".bid-form-container-active").classList.add("bid-form-container");
    document.querySelector(".bid-form-container").classList.remove("bid-form-container-active");
});

let date = new Date();
let month = date.getMonth()+1;
if (month < 10) {
    month = "0" + month;
}
let day = date.getDate();
if (day < 10) {
    day = "0" + day;
}
let hour = date.getHours();
if (hour < 10) {
    hour = "0" + hour;
}
let minutes = date.getMinutes();
if (minutes < 10) {
    minutes = "0" + minutes;
}


let currentDate = date.getFullYear() + "-" + month + "-" + day + "T" + hour + ":" + minutes;
console.log(currentDate);
document.getElementById("meeting-time").setAttribute('min', currentDate);

*/