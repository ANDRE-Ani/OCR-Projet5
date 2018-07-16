// geolocalisation
/* myPosition = document.getElementById("myPosition")

function getCoords(position) {
    lat = position.coords.latitude
    pos = "Latitude : " + lat + "<br>";
    pos += "Longitude: " + position.coords.longitude + "<br>";
    // pos += "Altitude : " + position.coords.altitude + "<br>";
    // pos += "Précision: " + position.coords.accuracy + "m";
    myPosition.innerHTML = pos;
    myPosition.className = "ok"
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
        errorMsg, { enableHighAccuracy: true, timeout: 60 * 1000 })
} else {
    myPosition.innerHTML = "Géolocalisation non supportée par ce navigateur !"
    myPosition.className = "ko"
} */