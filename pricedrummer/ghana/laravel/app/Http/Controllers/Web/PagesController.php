<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
	public function home()
	{
		return view( 'pages.index', compact( 'categories' ) );
	}

	public function About()
	{
		return view( 'pages.static.about' );
	}

	public function Careers()
	{
		return view( 'pages.static.careers' );
	}

	public function AllCategories()
	{
//		Alphabets listing for navigation
		$alphabets = range('A', 'Z');

		$display_categories = [];
//      Get all the level one categories
		$lvl_one = fetch_data( '/api/v1/categories?level=1' );
		$data = $lvl_one->data;
//      Retrieve the level one category_id
		foreach ( $data as $category ) {
			$cat_lvl1_id = $category->category_id;
//          Pass it to the categoriesl2n3n4?pcat=level1
			$data = fetch_data( '/api/v1/categoriesl2n3n4?pcat=' . $cat_lvl1_id );
			$categories = $data->data;
//			dd( $categories );
			 foreach ( $categories as $lvl_two ) {
//			 	dd( $lvl_two );
			 	if ( ! empty( $lvl_two->lev3s ) ) {
//			 		Level threes are present
				    foreach ( $lvl_two->lev3s as $lvl_three ) {
				    	if ( ! empty( $lvl_three->has_level_4 ) ) {
//						    There's level four here
						    foreach ( $lvl_three->lev4s as $lvl_four ) {
						    	$display_categories[] = $lvl_four;
						    }
					    } else {
//				    		No level four found
						    $display_categories[] = $lvl_three;
					    }
				    }
			    } else {
//			 		No level threes
			    }
			 }
		}

        usort( $display_categories, function( $key, $value ) {
			return strcmp( $key->name, $value->name );
		});
        
        return view( 'pages.static.all_categories' )
			->with( 'categories', $display_categories )
			->with( 'alphabets', $alphabets );
	}

	public function Press()
	{
		return view( 'pages.static.press' );
	}

	public function Contact()
	{
		return view( 'pages.static.contact' );
	}

	public function Guides()
	{
		return view( 'pages.static.guides' );
	}

	public function ForRetailers()
	{
		return view( 'pages.static.for_retailers' );
	}

	public function TermsPolicy()
	{
		return view( 'pages.static.terms_policy' );
	}

	public function RulesRegulations()
	{
		return view( 'pages.static.rules_regulations' );
	}

	public function Faq()
	{
		return view( 'pages.static.faq' );
	}
}
