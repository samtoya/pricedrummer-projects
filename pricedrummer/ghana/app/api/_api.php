<?php
	// CORS enablement
	header("Access-Control-Allow-Origin: *");
	// set up request for access token
	$data = array(
	'client_id'=>"rC3BTCmZBGyjbUVnQmh4KbKGN5wTPosL9jShl7uk",
	'client_secret'=>"YGmDUukH4dzRYYuujio7SXbPnCWFx2YDhoub1HN4m2xZUSwPGBn9ZIhmAjoMP8XUVnPOPhx14jN3iikpMlnxJuShcMzNLOsEaRGE4sfxMO824xTSNogehREcRirANklo",
	'grant_type'=>"password",
	'username'=>"pxdm",
	'password'=>"7936_Pxd$*M"
	);

	// $request     = "138.68.135.191:8080/o/token/";
	// $request     = "http://138.68.135.191:8080/o/token/";
	$request     = "http://ghapi.pricedrummer.com/o/token/";
//	$request     = "http://api.pricedrummer.com.gh/o/token/";
	// $request   	    = "http://pricedrummer.com.gh/o/token/";
	$ch             = curl_init($request);
	curl_setopt_array($ch, array(
	CURLOPT_RETURNTRANSFER => TRUE,
	CURLOPT_SSL_VERIFYPEER => FALSE,
	CURLOPT_POSTFIELDS => $data
	));
  	$response = curl_exec($ch);
	curl_close($ch);
	// Check for errors
	if ($response === FALSE) {
		die(curl_error($ch));
	}
	// Decode the response
	$responseData = json_decode($response, TRUE);

	echo $access_token = $responseData["access_token"];
	// echo "<hr/>";
	// echo $refresh_token = $responseData["refresh_token"];

	// echo "<hr/>";
	// echo $response;

