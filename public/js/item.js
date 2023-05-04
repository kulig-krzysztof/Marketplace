mapboxgl.accessToken = 'pk.eyJ1Ijoia3VsaWcta3J6eXN6dG9mIiwiYSI6ImNsY3EydTJ5YzAxeHEzcXAwajJrOW1ncTgifQ.YRwmFveycWBp-xaTfTqRSQ';
const map = new mapboxgl.Map({
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
   marker.setLngLat(coordinates).addTo(map);
   document.getElementById("lng").setAttribute('value', lng);
   document.getElementById("lat").setAttribute('value', lat);
}
const button = document.querySelector("#add");
map.on('click', add_marker);
map.on('click', function()  {
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