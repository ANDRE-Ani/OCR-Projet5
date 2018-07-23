<div class="p-3 mb-2 bg-info text-white"><h5>Crypto-monnaies</h5></div>
<div class="fonct">

<?php
/* $api = "https://blockchain.info/ticker";
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
echo "1 Bitcoin vaut " . $rateJ . " " . $symbolJ . "<br>"; */



$api_url='https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,LTC&tsyms=USD,EUR';
$cryptocurrency = json_decode(file_get_contents($api_url));

foreach($cryptocurrency as $key => $value)
{
    $priceUSD = (float) $cryptocurrency->$key->USD;
    $priceEUR = (float) $cryptocurrency->$key->EUR;

    echo  "$key<br>";
    echo  '1 dollar ($) vaut : ' .$priceUSD.'<br>';
    echo  '1 euro (€) vaut : ' . $priceEUR.'<br>';
}

?>

</div>

</div>
