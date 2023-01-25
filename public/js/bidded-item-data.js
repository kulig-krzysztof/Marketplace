mapboxgl.accessToken = 'pk.eyJ1Ijoia3VsaWcta3J6eXN6dG9mIiwiYSI6ImNsY3EydTJ5YzAxeHEzcXAwajJrOW1ncTgifQ.YRwmFveycWBp-xaTfTqRSQ';
const map1 = new mapboxgl.Map({
    container: 'map', // container ID
// Choose from Mapbox's core styles, or make your own style with Mapbox Studio
    style: 'mapbox://styles/mapbox/streets-v12', // style URL
    center: [19.94498, 50.06465], // starting position [lng, lat]
    zoom: 9 // starting zoom
});

fetch("/offersOfBidder", {
    method: "GET"
}).then(function (response) {
    return response.json();
}).then(function(offersOfBidder) {
    offersOfBidder.map(offer => {
        offer.coordinates = [JSON.parse(offer.lng), JSON.parse(offer.lat)];
        offer.title = JSON.parse(offer.id)
        offer.description = JSON.parse(offer.price)
    });
    document.querySelector(".bidded-value").innerHTML = offersOfBidder[0].price + " zł";
    document.querySelector(".bid-state").innerHTML = offersOfBidder[0].state_of_offer;
    document.querySelector(".selected-city-name").innerHTML = offersOfBidder[0].city_name;
    document.querySelector(".selected-date").innerHTML = offersOfBidder[0].data;
    console.log(offersOfBidder[0].price)
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
    console.log(counterOffer[0].price)
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
                        `<h3>${feature.description}</h3><p>${feature.data}</p>`
                    )
            )
            .addTo(map1);
    }
}

function placeCounterOfferMarker(counterOffer) {
    for (const feature of counterOffer) {
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
            .addTo(map1);
    }
}