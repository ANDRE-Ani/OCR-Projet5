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