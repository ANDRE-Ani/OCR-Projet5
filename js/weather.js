// weather with geoloc from openweathermap

/* openWeatherMap = 'https://api.openweathermap.org/data/2.5/weather'
if (window.navigator && window.navigator.geolocation) {
    window.navigator.geolocation.getCurrentPosition(function(position) {
        $.getJSON(openWeatherMap, {
            lat: position.coords.latitude,
            lon: position.coords.longitude,
            units: 'metric',
            lang: 'fr',
            APPID: '8af0f894920fd7fcf2e0dc3b48605453'
        }).done(function(weather) {
            town = weather.name;
            tempL = weather.main.temp;
            humL = weather.main.humidity;
            pressL = weather.main.pressure;
            speedL = weather.wind.speed;
            desc = weather.weather[0].description;
            document.getElementById("weather").innerHTML = "<strong>" + town + "</strong>" + "<br>" + "<strong>" + " Conditions actuelles : " + "</strong>" + desc + "<br>" + "<strong>" + "Température : " + "</strong>" + tempL + "°" + "<strong>" + " Humidité : " + "</strong>" + humL + "%" + "<br>" + "<strong>" + "Pression : " + "</strong>" + pressL + "°" + "<strong>" + " Vent : " + "</strong>" + speedL;
        })
    })
} */


var weatherL = {
    /*openWeatherMap: "",
    town: "",
    tempL: "",
    humL: "",
    pressL: "",
    speedL: "",
    desc: "",*/

    weatherLoc: function() {
        this.town = town;
        this.tempL = tempL;
        this.humL = humL;
        this.pressL = pressL;
        this.speedL = speedL;
        this.openWeatherMap = openWeatherMap;
        this.openWeatherMap = 'https://api.openweathermap.org/data/2.5/weather'
        if (window.navigator && window.navigator.geolocation) {
            window.navigator.geolocation.getCurrentPosition(function(position) {
                $.getJSON(this.openWeatherMap, {
                    lat: position.coords.latitude,
                    lon: position.coords.longitude,
                    units: 'metric',
                    lang: 'fr',
                    APPID: '8af0f894920fd7fcf2e0dc3b48605453'
                }).done(function(weather) {
                    console.log(weather)
                    this.town = weather.name;
                    this.tempL = weather.main.temp;
                    this.humL = weather.main.humidity;
                    this.pressL = weather.main.pressure;
                    this.speedL = weather.wind.speed;
                    this.desc = weather.weather[0].description;
                    document.getElementById("weather").innerHTML = "Ville : " + weatherL.town + "<br>" + " Conditions actuelles : " + desc + "<br>" + "Température : " + tempL + "°" + " Humidité : " + humL + "%" + "<br>" + "Pression : " + pressL + "°" + " Vent : " + speedL;

                })
            })
        }
    }
}