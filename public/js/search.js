const search = document.querySelector(".name-search");
const searchLocation = document.querySelector(".location");
const articleContainer = document.querySelector('.categories');

if(search) {
    search.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();

            const data = {search: this.value};

            fetch("/search", {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(function (response) {
                return response.json();
            }).then(function (items) {
                articleContainer.innerHTML = "";
                loadArticles(items);
            })

        }
    });
}

if(searchLocation) {
    searchLocation.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();

            const data = {search: this.value};

            fetch("/search", {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(function (response) {
                return response.json();
            }).then(function (items) {
                articleContainer.innerHTML = "";
                loadArticles(items);
            })

        }
    });
}



    function loadArticles(items) {
        items.forEach(item => {
            console.log(item);
            createArticle(item);
        })
    }

    function  createArticle(item) {
        const template = document.querySelector("#template");

        const clone = template.content.cloneNode(true);
        const button = clone.querySelector("button");
        button.id = item.id;
        button.value = item.id;

        const image = clone.querySelector("img");
        image.src = `public/img/form-images/${item.img}`;
        const title = clone.querySelector("h2");
        title.innerHTML = item.title;
        const price = clone.querySelector("#price");
        price.innerHTML = "Cena: " + item.price + " zł";
        const location = clone.querySelector("#location");
        location.innerHTML = "Lokalizacja: " + item.city_name;

        articleContainer.appendChild(clone);
    }

/*

mapboxgl.accessToken = 'pk.eyJ1Ijoia3VsaWcta3J6eXN6dG9mIiwiYSI6ImNsY3EydTJ5YzAxeHEzcXAwajJrOW1ncTgifQ.YRwmFveycWBp-xaTfTqRSQ';
const map = new mapboxgl.Map({
    container: 'map', // container ID
// Choose from Mapbox's core styles, or make your own style with Mapbox Studio
    style: 'mapbox://styles/mapbox/streets-v12', // style URL
    center: [19.94498, 50.06465], // starting position [lng, lat]
    zoom: 9 // starting zoom
});

const geojson = {
    type: 'FeatureCollection',
    features: [
        {
            type: 'Feature',
            geometry: {
                type: 'Point',
                coordinates: [19.94498, 50.06465]
            },
            properties: {
                title: 'Dupa',
                description: 'Dupa dupa'
            }
        }
    ]
};

// add markers to map
for (const feature of geojson.features) {
// create a HTML element for each feature
    const el = document.createElement('div');
    el.className = 'marker';

// make a marker for each feature and add it to the map
    new mapboxgl.Marker(el)
        .setLngLat(feature.geometry.coordinates)
        .setPopup(
            new mapboxgl.Popup({ offset: 25 }) // add popups
                .setHTML(
                    `<h3>${feature.properties.title}</h3><p>${feature.properties.description}</p>`
                )
        )
        .addTo(map);
}

var marker = new mapboxgl.Marker();
var lng;
var lat;
function add_marker (event) {
    var coordinates = event.lngLat;
    lng = coordinates.lng;
    lat = coordinates.lat;
    console.log('Lng:', lng, 'Lat:', lat);
    marker.setLngLat(coordinates).addTo(map);
    document.getElementById("lng").setAttribute('value', lng);
    document.getElementById("lat").setAttribute('value', lat);
}
const button = document.querySelector("#add");
map.on('click', add_marker);

var date = new Date();
var currentDate = date.getFullYear() + "-" + date.getMonth()+1 + "-" + date.getDate() + "T" + date.getHours() + ":" + date.getMinutes();
console.log(currentDate);
document.getElementById("meeting-time").setAttribute('min', currentDate);


 */