<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Category;
use App\CompareProduct;

class catl2n3n4Contoller extends Controller
{
	public function index(Request $request, $page = 1, $limit = 15)
	{
		$params = Input::get();

		$get_my_level_2n3n4 = "";
		if ( ! empty( $params[ 'pcat' ] ) ) {
			$get_my_level_2n3n4 = $params[ 'pcat' ];
		}

		$Categories_all = array();
		$level2=array();
		$level3=array();
		$level4=array();

		//==============BUILDING SEARCH QUERY =============//
		//collect all level 2a
		$categories = Category::select( 'category_ID', 'category_ID as category_id', 'name', 'level', 'parent_id', 'standard_naming', 'display_order', 'crawl_image', 'category_image', 'posted_timestamp', 'rank', 'has_product', 'has_level_4', 'order_index' );

		$hops_categories = DB::table( 'category_hops_cached' )
			->where( 'parent_id', $get_my_level_2n3n4 )
			->where( 'parent_id', '<>', null )
			->pluck( 'category_id' );
		// print_r($hops_categories);s
		// die();
		$categories = $categories->whereIn( 'category_id', $hops_categories )->where('has_product','=','1')->where('level','=','2');
	

		$categories = $categories->get();
		$categories_Lev2s = $categories->toArray();

		//collect level 3s
		foreach ($categories_Lev2s as $key => $categorie_l2) {
			$lev2_id = $categorie_l2['category_ID'];
			
			$categories1 = Category::select( 'category_ID', 'category_ID as category_id', 'name', 'level', 'parent_id', 'standard_naming', 'display_order', 'crawl_image', 'category_image', 'posted_timestamp', 'rank', 'has_product', 'has_level_4', 'order_index' );

			$hops_categories = DB::table( 'category_hops_cached' )
				->where( 'parent_id', $lev2_id )
				->where( 'parent_id', '<>', null )
				->pluck( 'category_id' );

			$categories1 = $categories1->whereIn( 'category_id', $hops_categories )->where('has_product','=','1')->where('level','=','3');
			$categories1 = $categories1->get();
			$categories_Lev3s = $categories1->toArray();
			// print_r($categories_Lev3s);

			//collecting level 4s
			foreach ($categories_Lev3s as $key => $categorie_l3) {
				$lev3_id = $categorie_l3['category_ID'];
				$categories2 = Category::select( 'category_ID', 'category_ID as category_id', 'name', 'level', 'parent_id', 'standard_naming', 'display_order', 'crawl_image', 'category_image', 'posted_timestamp', 'rank', 'has_product', 'has_level_4', 'order_index' );

				$hops_categories = DB::table( 'category_hops_cached' )
					->where( 'parent_id', $lev3_id )
					->where( 'parent_id', '<>', null )
					->pluck( 'category_id' );

				$categories2 = $categories2->whereIn( 'category_id', $hops_categories )->where('has_product','=','1')->where('level','=','4');
				$categories2 = $categories2->get();
				$categories_Lev4s = $categories2->toArray();

				//add level 4
				foreach ($categories_Lev4s as $key => $categorie_l4) {
					$level4[] = $categorie_l4; //populate the level 4 container
				}

				//prepare the level 4 key for level 3
				$categorie_l3['lev4s'] = $level4;
				$level3[] = $categorie_l3;
				$level4 = [];
			}
		
			
		//prepare the level 3 key for the level 2 
		$categorie_l2['lev3s'] = $level3;
		$Categories_all[] = $categorie_l2;
		$level3 = [];
		}
		//dd($Categories_all);
		
		//============== END OF BUILDING SEARCH QUERY =============//
		//-=============PAGINATION=============//
		// Set the request params.
		// Get the current page or default to 1
		$page  = Input::get( 'page', $page );
		$limit = Input::get( 'limit', $limit );;
		$offset = ( $page * $limit ) - $limit;

		return new LengthAwarePaginator( array_slice( $Categories_all, $offset, $limit, true ), count( $Categories_all ), $limit, $page, [ 'path' => $request->url(), 'query' => $request->query() ] );

		// return $Categories_all->jsonSerialize();
	}

}
