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
// 
Route::get('api', function() {
	return "I'm here";
});

Route::post( 'user', 'Api\v1\AuthController@store' );
Route::post( 'user/login', 'Api\v1\AuthController@authenticate' );

// Apply the jwt.auth as middleware for token-based authentication
Route::group([ 'namespace' => "Api", 'prefix' => 'v1', 'middleware' => ['cors'] ], function () {
	Route::resource( 'categories', 'v1\CategoriesController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'merchants', 'v1\MerchantsController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'products', 'v1\ProductsController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'sc', 'v1\ScController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'scimages', 'v1\ScImagesController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'productcompare', 'v1\CompareProductsController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'guide', 'v1\BuyingGuideController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'retailers', 'v1\RetailersController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'retailer_products', 'v1\RetailerProductsController', [ 'only' => [ 'index', 'show' ] ] );

	Route::resource( 'categoriesl2n3n4', 'v1\catl2n3n4Contoller', [ 'only' => [ 'index', 'show' ] ] );
} );