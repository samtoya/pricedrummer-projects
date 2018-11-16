<?php
function baseURL()
{
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
$all_info = [];

//CHANGE USERS AND DATABASES BASED ON THE URL THAT IS REQUESTING THE APP
switch ( $Base_Url ) {
	case "http://ng.pricedrummer.com":
		//RETURN THE COUNTRY NAME
		$all_info[ "country" ]         = "Nigeria";
		$all_info[ "country_name" ]    = "nigeria";
		$all_info[ "currency" ]        = "₦";
		$all_info[ "country_url" ]     = "http://ng.pricedrummer.com";
		$all_info[ "country_api_url" ] = "http://ngapi.pricedrummer.com/api/";
		$all_info[ "country_title" ]   = "in Nigeria";
		$all_info[ "facebook_plugin" ]   = "https://www.facebook.com/PriceDrummerNG/";
		$all_info[ "social_media" ]    = [
			"Blog"      => "http://blog.pricedrummer.com",
			"Facebook"  => "https://www.facebook.com/PriceDrummerNG/",
			"Instagram" => "https://www.instagram.com",
			"Twitter"   => "https://www.twitter.com",
			"LinkedIn"  => "https://www.linkedin.com/company-beta/15228908",
		];
		break;

	case "http://za.pricedrummer.com":
		//RETURN THE COUNTRY NAME
		$all_info[ "country" ]         = "South Africa";
		$all_info[ "country_name" ]    = "southafrica";
		$all_info[ "currency" ]        = "ZAR";
		$all_info[ "country_url" ]     = "http://za.pricedrummer.com";
		$all_info[ "country_api_url" ] = "http://zapi.pricedrummer.com/api/";
		$all_info[ "country_title" ]   = "in South Africa";
		$all_info[ "facebook_plugin" ]   = "https://www.facebook.com/PriceDrummerZA";
		$all_info[ "social_media" ]    = [
			"Blog"      => "http://blog.pricedrummer.com",
			"Facebook"  => "https://www.facebook.com/PriceDrummerZA",
			"Instagram" => "https://www.instagram.com",
			"Twitter"   => "https://www.twitter.com",
			"LinkedIn"  => "https://www.linkedin.com/company-beta/15228908",
		];
		break;

	case "http://ke.pricedrummer.com":
		//RETURN THE COUNTRY NAME
		$all_info[ "country" ]         = "Kenya";
		$all_info[ "country_name" ]    = "kenya";
		$all_info[ "currency" ]        = "KES";
		$all_info[ "country_url" ]     = "http://ke.pricedrummer.com";
		$all_info[ "country_api_url" ] = "http://keapi.pricedrummer.com/api/";
		$all_info[ "country_title" ]   = "in Kenya";
		$all_info[ "facebook_plugin" ]   = "https://www.facebook.com/PriceDrummerKE/";
		$all_info[ "social_media" ]    = [
			"Blog"      => "http://blog.pricedrummer.com",
			"Facebook"  => "https://www.facebook.com/PriceDrummerKE/",
			"Instagram" => "https://www.instagram.com",
			"Twitter"   => "https://www.twitter.com",
			"LinkedIn"  => "https://www.linkedin.com/company-beta/15228908",
		];
		break;

	case "http://gh.pricedrummer.com":
		//RETURN THE COUNTRY NAME
		$all_info[ "country" ]         = "Ghana";
		$all_info[ "country_name" ]    = "ghana";
		$all_info[ "currency" ]        = "GH¢";
		$all_info[ "country_url" ]     = "http://gh.pricedrummer.com";
		$all_info[ "country_api_url" ] = "http://ghapi.pricedrummer.com/api/";
		$all_info[ "country_title" ]   = "in Ghana";
		$all_info[ "facebook_plugin" ]   = "https://www.facebook.com/PriceDrummerGH/";
		$all_info[ "social_media" ]    = [
			"Blog"      => "http://blog.pricedrummer.com",
			"Facebook"  => "http://www.facebook.com/PriceDrummerGH",
			"Instagram" => "http://www.instagram.com/pricedrummer_gh/",
			"Twitter"   => "http://twitter.com/PriceDrummer_GH",
			"LinkedIn"  => "https://www.linkedin.com/company-beta/15228908",
		];
		break;

	case "http://mu.pricedrummer.com":
		//RETURN THE COUNTRY NAME
		$all_info[ "country" ]         = "Mauritius";
		$all_info[ "country_name" ]    = "mauritius";
		$all_info[ "currency" ]        = "₨";
		$all_info[ "country_url" ]     = "http://mu.pricedrummer.com";
		$all_info[ "country_api_url" ] = "http://muapi.pricedrummer.com/api/";
		$all_info[ "country_title" ]   = "in Mauritius";
		$all_info[ "facebook_plugin" ]   = "https://www.facebook.com/PriceDrummerMU";
		$all_info[ "social_media" ]    = [
			"Blog"      => "http://blog.pricedrummer.com",
			"Facebook"  => "https://www.facebook.com/PriceDrummerMU",
			"Instagram" => "#",
			"Twitter"   => "#",
			"LinkedIn"  => "https://www.linkedin.com/company-beta/15228908",
		];
		break;

	case "http://eg.pricedrummer.com":
		//RETURN THE COUNTRY NAME
		$all_info[ "country" ]         = "Egypt";
		$all_info[ "country_name" ]    = "egypt";
		$all_info[ "currency" ]        = "£";
		$all_info[ "country_url" ]     = "http://eg.pricedrummer.com";
		$all_info[ "country_api_url" ] = "http://egapi.pricedrummer.com/api/";
		$all_info[ "country_title" ]   = "in Egypt";
		$all_info[ "facebook_plugin" ]   = "https://www.facebook.com/PriceDrummerEG/";
		$all_info[ "social_media" ]    = [
			"Blog"      => "http://blog.pricedrummer.com",
			"Facebook"  => "https://www.facebook.com/PriceDrummerEG/",
			"Instagram" => "https://www.instagram.com",
			"Twitter"   => "https://www.twitter.com",
			"LinkedIn"  => "https://www.linkedin.com/company-beta/15228908",
		];
		break;
}
echo json_encode( $all_info );

