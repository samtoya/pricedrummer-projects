<?php

use Illuminate\Support\Facades\Mail;
/************************************************************************
 *******    PriceDrummer Routes *******
 ************************************************************************/

/*============================ Root Path ============================*/
Route::get( '/', 'Web\HomeController@index' );
Route::post( '/newsletter', 'Web\HomeController@newsletter' )->name('newsletter');

/*============================ Dynamic Pages ============================*/
Route::get( '/compare/{sc_id}/{product_id}', 'Web\CompareController@index' );
Route::get( '/category/{category_id}/{category_name}', 'Web\CategoryController@index' );
Route::get( '/filter/{id}/{category_name}', 'Web\FilterController@index' );
Route::get( '/search', 'Web\FilterController@search' );
Route::get( '/s/{search_param}', 'Web\FilterController@search_not_found' );
Route::get( '/filter/{id}/{category_name}', 'Web\FilterController@index' );
Route::get( '/contact_seller/{sc_id}/{product_id}', 'Web\ContactSellerController@index' );
Route::post( '/contact_seller/{retailer_id}', 'Web\ContactSellerController@mail' );
Route::get( '/member/{company_name}', 'Web\MemberController@index' );
// Route::get( '/member', 'Web\MemberController@new' );
Route::get( '/redirect/{product_id}', 'Web\RedirectController@index' );
Route::post( '/redirect', 'Web\RedirectController@index' );

Route::get( '/grid', function () {
	return view( 'pages.dynamic.filter_grid' );
} );

Route::get( '/list', function () {
	return view( 'pages.dynamic.filter_list' );
} );

Route::get( 'mail', function () {
	Mail::send( 'emails.test', [], function( $message ) {
		$message->to('josephakitoye@gmail.com')
		        ->subject('Contact Seller Test');
	});
} );


/*============================ Static Pages ============================*/
Route::get( '/about', 'Web\PagesController@About' );
Route::get( '/careers', 'Web\PagesController@Careers' );
Route::get( '/all_categories', 'Web\PagesController@AllCategories' );
Route::get( '/press', 'Web\PagesController@Press' );
Route::get( '/contact', 'Web\PagesController@Contact' );
Route::get( '/guides', 'Web\PagesController@Guides' );
Route::get( '/for_retailers', 'Web\PagesController@ForRetailers' );
Route::get( '/terms_policy', 'Web\PagesController@TermsPolicy' );
Route::get( '/rules_regulations', 'Web\PagesController@RulesRegulations' );
Route::get( '/faq', 'Web\PagesController@Faq' );


/*============================ Authentication ============================*/
Auth::routes();


Route::get( '/pages', 'HomeController@index' );
//Route::get( 'login', 'AuthController@authenticate' );
