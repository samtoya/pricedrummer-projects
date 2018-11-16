<?php
$API_KEY = "6p7qdbxwvtsvjjusf97hx7yf";
//Get  Detais for each car MAKE-MODEL-YEAR
$Transmission_url= "https://api.edmunds.com/api/vehicle/v2/lexus/rx350/2011/styles?fmt=json&api_key=".$API_KEY;

$curl_channel = curl_init();
curl_setopt($curl_channel, CURLOPT_URL, $Transmission_url);
		//curl_setopt($curl_channel, CURLOPT_PROXY, $proxy);
curl_setopt($curl_channel, CURLOPT_HEADER, FALSE);
curl_setopt($curl_channel, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl_channel, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($curl_channel, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_channel, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($curl_channel, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($curl_channel, CURLOPT_REFERER, $referer);
curl_setopt($curl_channel, CURLOPT_USERAGENT, $agent);

$result['EXE'] = curl_exec($curl_channel);
$result['INF'] = curl_getinfo($curl_channel);
$result['ERR'] = curl_error($curl_channel);

			//$Transmissions_Details = file_get_contents($Transmission_url);
			//$CarTransmissions = json_decode($Transmissions_Details);
echo"<hr/><pre>";
print_r($result);
echo"</pre><hr/>";

?>