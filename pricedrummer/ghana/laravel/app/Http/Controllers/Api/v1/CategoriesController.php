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


class CategoriesController extends Controller
{

	protected $query_fields = [ 'parent_id', 'rank', 'has_product' ]; // Name,all_parent_id,level
	protected $ordering = [ 'min_price', 'max_price', 'category_id' ];

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param int                      $page
	 * @param int                      $limit
	 *
	 * @return mixed paginated array results of json objects.
	 */

	public function index(Request $request, $page = 1, $limit = 15)
	{
		$params = Input::get();

		$CategorySearchParams = [];
		if ( ! empty( $params ) ) {
			$CategorySearchParams = $this->getCategorySearch( $params );
		}
		$x_search = "";
		if ( ! empty( $params[ 'xsearch' ] ) ) {
			$x_search = $params[ 'xsearch' ];
		}
		$category_Name = "";
		if ( ! empty( $params[ 'name' ] ) ) {
			$category_Name = $params[ 'name' ];
		}

		$category_Level = "";
		if ( ! empty( $params[ 'level' ] ) ) {
			$category_Level = $params[ 'level' ];
		}
		$category_all_parent_id = "";
		if ( ! empty( $params[ 'all_parent_id' ] ) ) {
			$category_all_parent_id = $params[ 'all_parent_id' ];
		}
		$get_my_level_3 = "";
		if ( ! empty( $params[ 'get_my_3' ] ) ) {
			$get_my_level_3 = $params[ 'get_my_3' ];
		}
		$get_my_level_2n3n4 = "";
		if ( ! empty( $params[ 'get_my_2n3n4' ] ) ) {
			$get_my_level_2n3n4 = $params[ 'get_my_2n3n4' ];
		}


		//==============BUILDING SEARCH QUERY =============//
		$categories = Category::where( $CategorySearchParams )->select( 'category_ID', 'category_ID as category_id', 'name', 'level', 'parent_id', 'standard_naming', 'display_order', 'crawl_image', 'category_image', 'posted_timestamp', 'rank', 'has_product', 'has_level_4', 'order_index' );

		if ( ! empty( $category_Name ) ) {
			$categories = $categories->where( 'name', 'LIKE', "%$category_Name%" );
		}
		if ( ! empty( $category_Level ) ) {
			$categories = $categories->whereIn( 'level', $this->prepWhereIn( $category_Level ) );
		}
		if ( ! empty( $category_all_parent_id ) ) {
			$hops_categories = DB::table( 'category_hops_cached' )
				->where( 'parent_id', $category_all_parent_id )
				->where( 'parent_id', '<>', null )
				->pluck( 'category_id' );
			// print_r($hops_categories);
			// die();
			$categories = $categories->whereIn( 'category_id', $hops_categories );
		}
		if ( ! empty( $get_my_level_3 ) ) {
			$hops_categories = DB::table( 'category_hops_cached' )
				->where( 'parent_id', $get_my_level_3 )
				->where( 'parent_id', '<>', null )
				->pluck( 'category_id' );
			// print_r($hops_categories);
			// die();
			$categories = $categories->whereIn( 'category_id', $hops_categories )->where('has_product','=','1')->where('level','=','3');
		}

		if ( ! empty( $x_search ) ) {
			$categories                    = $categories->where( 'name', 'LIKE', "%$x_search%" );
			$compare_products_category_ids = CompareProduct::where( 'name', 'LIKE', "%$x_search%" )->pluck( 'category' );
			//dd($compare_products_category_ids);
			//query the categories by the search parameter
			$categories = $categories->orWhereIn( 'category_id', $compare_products_category_ids );
		}
		$categories = $categories->with( 'category_detail' )
			->get()->sortBy('order_index');
		$categories = $categories->toArray();
		//============== END OF BUILDING SEARCH QUERY =============//
		//-=============PAGINATION=============//
		// Set the request params.
		// Get the current page or default to 1
		$page  = Input::get( 'page', $page );
		$limit = Input::get( 'limit', $limit );;
		$offset = ( $page * $limit ) - $limit;

		return new LengthAwarePaginator( array_slice( $categories, $offset, $limit, true ), count( $categories ), $limit, $page, [ 'path' => $request->url(), 'query' => $request->query() ] );

		// return $categories->jsonSerialize();
	}

	protected function getCategorySearch($params)
	{
		$clause = [];
		foreach ( $this->query_fields as $field ) {
			if ( in_array( $field, array_keys( $params ) ) ) {
				$values = explode(",",$params[$field]); //explode the values if there i a comma seperated values for a given search query feild
				$clause[ $field ] = $values;

			}
		}
		return $clause;
	}

	protected function prepWhereIn($val)
	{
		$values = explode( ",", $val ); //explode the values if there i a comma seperated values for a given search query feild
		return $values;
	}

	/**
	 * @param $id
	 *
	 * @return array of json object.
	 */

	public function show($id)
	{
		$category = new Category;
		$category = $category->select( 'category_ID', 'category_ID as category_id', 'name', 'level', 'parent_id', 'standard_naming', 'display_order', 'crawl_image', 'category_image', 'posted_timestamp', 'rank', 'has_product', 'has_level_4', 'order_index' );
		$category = $category->with( 'category_detail' )->where( 'category_ID', $id )->firstOrFail();
		return $category->jsonSerialize();
	}
}
