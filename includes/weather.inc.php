<div class="p-3 mb-2 bg-info text-white"><h5>Météo</h5></div>
<div class="fonct">



<script type='text/javascript'>

var openWeatherMap = 'https://api.openweathermap.org/data/2.5/weather'
if (window.navigator && window.navigator.geolocation) {
    window.navigator.geolocation.getCurrentPosition(function(position) {
        $.getJSON(openWeatherMap, {
            lat: position.coords.latitude,
            lon: position.coords.longitude,
            units: 'metric',
            lang: 'fr',
            APPID: '8af0f894920fd7fcf2e0dc3b48605453'
        }).done(function(weather) {
            console.log(weather)
            var town = weather.name;
        var tempL = weather.main.temp;
        var humL = weather.main.humidity;
        var pressL = weather.main.pressure;
        var speedL = weather.wind.speed;
        var desc = weather.weather[0].description;
        document.getElementById("weather").innerHTML = "Ville : " + town + "<br>" + " Conditions actuelles : " + desc + "<br>" + "Température : " + tempL + "°" + " Humidité : " + humL + "%" + "<br>" + "Pression : " + pressL + "°" + " Vent : " + speedL;
    
        })
    })
}


</script>



<div id="weather">
</div>
</div>

</div>