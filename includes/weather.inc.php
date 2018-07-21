<div class="p-3 mb-2 bg-info text-white"><h5>Météo</h5></div>
<div class="fonct">

<?php
// get weather info from openweathermap
$url = "https://api.openweathermap.org/data/2.5/weather?q=Bourges&units=metric&lang=fr&APPID=8af0f894920fd7fcf2e0dc3b48605453";

// $url = "https://api.openweathermap.org/data/2.5/weather?lat=latPos&lon=lngPos&units=metric&lang=fr&APPID=8af0f894920fd7fcf2e0dc3b48605453";

$contents = file_get_contents($url);
$weatherU=json_decode($contents);

$temp_temp = $weatherU->main->temp;
$temp_hum = $weatherU->main->humidity;
$temp_press=$weatherU->main->pressure;
$temp_wind=$weatherU->wind->speed;
$temp_desc=$weatherU->weather[0]->description;
$icon=$weatherU->weather[0]->icon.".png";

$cityname = $weatherU->name;

echo $cityname . "<br>";

echo "<img src='http://openweathermap.org/img/w/" . $icon ."'/ >" . $temp_desc . "<br>";
echo "Température : " . $temp_temp . "°C" . " - Humidité : " . $temp_hum . "%" . "<br>";
echo "Pression : " . $temp_press . "°" . " - Vent : " . $temp_wind ."<br>";

?>

</div>
</div>
