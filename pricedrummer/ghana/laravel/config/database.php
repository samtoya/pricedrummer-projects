<?php

//COLLECT THE CURRENT PAGE URL
$Base_Url = baseURL();
//dd($Base_Url);
//die( $Base_Url );
$country  = '';
$DB_CONNECTION = "mysql";
$DB_HOST       = "127.0.0.1";
$DB_PASSWORD = "7936_Pxd$*M";
$DB_PORT     = "3306";

//CHANGE USERS AND DATABASES BASED ON THE URL THAT IS REQUESTING THE APP
switch ( $Base_Url ) {
    case "http://n.pricedrummer.com":
        $DB_DATABASE = "pxdm_cr";
        $DB_USERNAME = "root";
        break;

    case "localhost":
        $DB_DATABASE = "pxdm_cr";
        $DB_USERNAME = "root";
        break;

    case "http://ng.pricedrummer.com":
        $DB_DATABASE = "pxdm_ng";
        $DB_USERNAME = "pxdm_ng";
        break;

    case "http://za.pricedrummer.com":
        $DB_DATABASE = "pxdm_sa";
        $DB_USERNAME = "pxdm_sa";
        break;

    case "http://ke.pricedrummer.com":
        $DB_DATABASE = "pxdm_ke";
        $DB_USERNAME = "pxdm_ke";
        break;

    case "http://gh.pricedrummer.com":
        $DB_DATABASE = "pxdm_cr";
        $DB_USERNAME = "root";
        break;

    case "http://mu.pricedrummer.com":
        $DB_DATABASE = "pxdm_mu";
        $DB_USERNAME = "pxdm_mu";
        break;

    case "http://eg.pricedrummer.com":
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

        'mysql1' => [
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
