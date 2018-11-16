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
$DB_CONNECTION = "mysql";
$DB_HOST       = "127.0.0.1";
$DB_PASSWORD = "7936_Pxd$*M";
$DB_PORT     = "3306";

//CHANGE USERS AND DATABASES BASED ON THE URL THAT IS REQUESTING THE APP
switch ( $Base_Url ) {
	case "http://ngapi.pricedrummer.com":
		$DB_DATABASE = "pxdm_ng";
		$DB_USERNAME = "pxdm_ng";
		break;

	case "http://zapi.pricedrummer.com":
		$DB_DATABASE = "pxdm_sa";
		$DB_USERNAME = "pxdm_sa";
		break;

	case "http://keapi.pricedrummer.com":
		$DB_DATABASE = "pxdm_ke";
		$DB_USERNAME = "pxdm_ke";
		break;

	case "http://ghapi.pricedrummer.com":
		$DB_DATABASE = "pxdm_cr";
		$DB_USERNAME = "pxdm_gh";
		break;

	case "http://muapi.pricedrummer.com":
		$DB_DATABASE = "pxdm_mu";
		$DB_USERNAME = "pxdm_mu";
		break;

	case "http://egapi.pricedrummer.com":
		$DB_DATABASE = "pxdm_eg";
		$DB_USERNAME = "pxdm_eg";
		break;
}

return [

	'default' => env( 'DB_CONNECTION', 'mysql' ),

	'connections' => [

		'sqlite' => [
			'driver'   => 'sqlite',
			'database' => env( 'DB_DATABASE', database_path( 'database.sqlite' ) ),
			'prefix'   => '',
		],

		'mysql' => [
			'driver'    => 'mysql',
			'host'      => $DB_HOST,
			'port'      => $DB_PORT,
			'database'  => $DB_DATABASE,
			'username'  => $DB_USERNAME,
			'password'  => $DB_PASSWORD,
			'charset'   => 'utf8mb4',
			'collation' => 'utf8mb4_unicode_ci',
			'prefix'    => '',
			'strict'    => true,
			'engine'    => null,
		],

		'pgsql' => [
			'driver'   => 'pgsql',
			'host'     => env( 'DB_HOST', '127.0.0.1' ),
			'port'     => env( 'DB_PORT', '5432' ),
			'database' => env( 'DB_DATABASE', 'forge' ),
			'username' => env( 'DB_USERNAME', 'forge' ),
			'password' => env( 'DB_PASSWORD', '' ),
			'charset'  => 'utf8',
			'prefix'   => '',
			'schema'   => 'public',
			'sslmode'  => 'prefer',
		],

	],

	'migrations' => 'migrations',

	'redis' => [

		'client' => 'predis',

		'default' => [
			'host'     => env( 'REDIS_HOST', '127.0.0.1' ),
			'password' => env( 'REDIS_PASSWORD', null ),
			'port'     => env( 'REDIS_PORT', 6379 ),
			'database' => 0,
		],

	],

];
