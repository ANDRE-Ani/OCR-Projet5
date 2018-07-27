var latPos = '';
var lngPos = '';

// geolocalisation
myPosition = document.getElementById("myPosition")

function getCoords(position) {
    lat = position.coords.latitude
    lng = position.coords.longitude
    pos = "- Latitude : " + lat + "<br>";
    pos += "- Longitude: " + position.coords.longitude + "<br>";
    myPosition.innerHTML = pos;
    myPosition.className = "ok"

    latPos = position.coords.latitude;
    lngPos = position.coords.longitude;
}

function errorMsg(error) {
    msg = {
        1: "Accès à la position non autorisé",
        2: "Position non trouvée",
        3: "Délai expiré"
    }
    myPosition.innerHTML = msg[error.code]
    myPosition.className = "ko"
}
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(getCoords,
        errorMsg, {
            enableHighAccuracy: true,
            timeout: 60 * 1000
        })
} else {
    myPosition.innerHTML = "Géolocalisation non supportée par ce navigateur !"
    myPosition.className = "ko"
}



// JS for leaflet map

navigator.geolocation.getCurrentPosition(function(location) {
    var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

    var mymap = L.map('map').setView(latlng, 13)
    L.tileLayer(
        'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://mapbox.com">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1IjoiYW5kcmUwYW5pIiwiYSI6ImNqam5zZ2tjbDFmdHIzcXF2Mmp1ZmR2M2cifQ.Leo55txTsN0i05KAB2vRew'
        }).addTo(mymap);

    var popup = L.popup();

    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("Position : " + e.latlng.toString())
            .openOn(mymap);
    }
    mymap.on('click', onMapClick);

    var marker = L.marker(latlng).addTo(mymap);

});