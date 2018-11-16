<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware( 'auth:api' )->get( '/user', function (Request $request) {
//	return $request->user();
//} );

// Display all SQL executed in Eloquent
// \Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
//     var_dump($query->sql);
//     var_dump($query->bindings);
//     var_dump($query->time);
// });

Route::post( 'user', 'AuthController@store' );
Route::post( 'user/login', 'AuthController@authenticate' );

Route::group( [ 'middleware' => ['jwt.auth', 'cors'] ], function () {
	Route::resource( 'categories', 'CategoriesController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'merchants', 'MerchantsController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'products', 'ProductsController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'sc', 'ScController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'scimages', 'ScImagesController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'productcompare', 'CompareProductsController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'guide', 'BuyingGuideController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'retailers', 'RetailersController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'retailer_products', 'RetailerProductsController', [ 'only' => [ 'index', 'show' ] ] );
} );