<?php
function baseURL() {
	$pageURL = 'http';
	if ( isset( $_SERVER[ "HTTPS" ] ) and $_SERVER[ 'HTTPS' ] == "on" ) {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ( $_SERVER[ "SERVER_PORT" ] != "80" ) {
		$pageURL .= $_SERVER[ "SERVER_NAME" ] . ":" . $_SERVER[ "SERVER_PORT" ];
	} else {
		$pageURL .= $_SERVER[ "SERVER_NAME" ];
	}

	return $pageURL;
}

//COLLECT THE CURRENT PAGE URL
$Base_Url = baseURL();
$country  = '';
//CHANGE USERS AND DATABASES BASED ON THE URL THAT IS REQUESTING THE APP
switch ( $Base_Url ) {
	case "http://ng.pricedrummer.com":
		//RETURN THE COUNTRY NAME
		echo "in Nigeria";
		break;

	case "http://sa.pricedrummer.com":
		//RETURN THE COUNTRY NAME
		echo "in South Africa";
		break;

	case "http://ke.pricedrummer.com":
		//RETURN THE COUNTRY NAME
		echo "in Kenya";
		break;

	case "http://gh.pricedrummer.com":
		//RETURN THE COUNTRY NAME
		echo "in Ghana";
		break;

	case "http://mu.pricedrummer.com":
		//RETURN THE COUNTRY NAME
		echo "in Mauritius";
		break;

	case "http://eg.pricedrummer.com":
		//RETURN THE COUNTRY NAME
		echo "in Egypt";
		break;
}
?>
