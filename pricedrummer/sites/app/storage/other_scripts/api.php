<?php
// CORS enablement
//header( "Access-Control-Allow-Origin: *" );
// set up request for access token
$data = [
	'username' => "pxdm_api",
	'password' => "7936_Pxd$*M",
];

$request = "http://egapi.pricedrummer.com/api/user/login";
// $request     = "138.68.135.191:8080/o/token/";
// $request     = "http://138.68.135.191:8080/o/token/";
//	$request     = "http://ghapi.pricedrummer.com/o/token/";
//	$request     = "http://api.pricedrummer.com.gh/o/token/";
// $request   	    = "http://pricedrummer.com.gh/o/token/";
$ch = curl_init( $request );
curl_setopt_array( $ch, [
	CURLOPT_RETURNTRANSFER => TRUE,
	CURLOPT_SSL_VERIFYPEER => FALSE,
	CURLOPT_POSTFIELDS     => $data,
] );
$response = curl_exec( $ch );
curl_close( $ch );
// Check for errors
if ( $response === FALSE ) {
	die( curl_error( $ch ) );
}
//echo  $response;
// Decode the response
$responseData = json_decode( $response, TRUE );
// echo"rr";
echo $access_token = $responseData[ "token" ];
// echo "<hr/>";
// echo $refresh_token = $responseData["refresh_token"];

// echo "<hr/>";
// echo $response;

