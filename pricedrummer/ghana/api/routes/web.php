<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( '/', function () {
	$api_uri = $_SERVER[ 'HTTP_HOST' ] . '/api/';
	$api_links = [
		'merchants'  => $api_uri . 'merchants',
		'categories' => $api_uri . 'categories',
		'sc' => $api_uri . 'sc',
		'scimages' => $api_uri . 'scimages',
		'products' => $api_uri . 'products',
		'productcompare' => $api_uri . 'productcompare',
		'guide' => $api_uri . 'guide',
		'retailers' => $api_uri . 'retailers'
	];
	return view( 'home.index')->with('api_links', $api_links);
} );

Auth::routes();

Route::get('/home', 'HomeController@index');
//Route::get( 'login', 'AuthController@authenticate' );
