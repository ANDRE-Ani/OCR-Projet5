<div class="p-3 mb-2 bg-info text-white"><h5>Cours du Bitcoin</h5></div>
<div class="fonct">

<?php
$api = "https://blockchain.info/ticker";
$json = file_get_contents($api);
$data = json_decode($json, TRUE);
$rateE = $data["EUR"]["last"];
$rateU = $data["USD"]["last"];
$rateJ = $data["JPY"]["last"];
$symbolE = $data["EUR"]["symbol"];
$symbolU = $data["USD"]["symbol"];
$symbolJ = $data["JPY"]["symbol"];
echo "1 Bitcoin vaut " . $rateE . " " . $symbolE . "<br>";
echo "1 Bitcoin vaut " . $rateU . " " . $symbolU . "<br>";
echo "1 Bitcoin vaut " . $rateJ . " " . $symbolJ . "<br>";
?>
</div>

</div>
