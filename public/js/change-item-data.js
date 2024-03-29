mapboxgl.accessToken = 'pk.eyJ1Ijoia3VsaWcta3J6eXN6dG9mIiwiYSI6ImNsY3EydTJ5YzAxeHEzcXAwajJrOW1ncTgifQ.YRwmFveycWBp-xaTfTqRSQ';
const map1 = new mapboxgl.Map({
    container: 'map', // container ID
// Choose from Mapbox's core styles, or make your own style with Mapbox Studio
    style: 'mapbox://styles/mapbox/streets-v12', // style URL
    center: [19.94498, 50.06465], // starting position [lng, lat]
    zoom: 9 // starting zoom
});

const map2 = new mapboxgl.Map({
    container: 'map2', // container ID
// Choose from Mapbox's core styles, or make your own style with Mapbox Studio
    style: 'mapbox://styles/mapbox/streets-v12', // style URL
    center: [19.94498, 50.06465], // starting position [lng, lat]
    zoom: 9 // starting zoom
});

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
map1.on('click', add_marker);

fetch("/allOffersForItem", {
    method: "GET"
}).then(function (response) {
    return response.json();
}).then(function(offers) {
    offers.map(offer => {
        offer.coordinates = [JSON.parse(offer.lng), JSON.parse(offer.lat)];
        offer.title = JSON.parse(offer.id)
        offer.description = JSON.parse(offer.price)
    });
    console.log(offers)
    placeMarkers(offers);
});

function placeMarkers(offers) {
    for (const feature of offers) {
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
                        `<h3>${feature.description}</h3><p>${feature.data}</p>
                         <form method="post" action="acceptOffer"><input type="hidden" name="id" value="${feature.id}"><input type="submit" name="accept" value="Accept"></form>
                         <form method="post" action="declineOffer"><input type="hidden" name="id" value="${feature.id}"><input type="submit" name="decline" value="Decline"></form>
                         <form method="post" action="respondToOffer"><input type="hidden" name="id" value="${feature.id}"><input type="submit" name="respond" value="Respond"></form>
                        `
                    )
            )
            .addTo(map2);
    }
}


