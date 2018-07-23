// weather with geoloc from openweathermap

var weatherL = {
    openWeatherMap: "",
    town: "",
    tempL: "",
    humL: "",
    pressL: "",
    speedL: "",
    desc: "",

    weatherLoc: function() {

        weatherL.openWeatherMap = 'https://api.openweathermap.org/data/2.5/weather'
        if (window.navigator && window.navigator.geolocation) {
            window.navigator.geolocation.getCurrentPosition(function(position) {
                $.getJSON(weatherL.openWeatherMap, {
                    lat: position.coords.latitude,
                    lon: position.coords.longitude,
                    units: 'metric',
                    lang: 'fr',
                    APPID: '8af0f894920fd7fcf2e0dc3b48605453'
                }).done(function(weather) {
                    // console.log(weather)
                    weatherL.town = weather.name;
                    weatherL.tempL = weather.main.temp;
                    weatherL.humL = weather.main.humidity;
                    weatherL.pressL = weather.main.pressure;
                    weatherL.speedL = weather.wind.speed;
                    weatherL.desc = weather.weather[0].description;
                    document.getElementById("weather").innerHTML = "Ville : " + weatherL.town + "<br>" + " Conditions actuelles : " + desc + "<br>" + "Température : " + tempL + "°" + " Humidité : " + humL + "%" + "<br>" + "Pression : " + pressL + "°" + " Vent : " + speedL;

                })
            })
        }
    }
}