<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\CompareProduct;
use App\ScDetail;
use App\Compare_detail;
use App\Services\CompareProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class CompareProductsController extends Controller
{
	protected $compare_products_service;
	protected $ordering = [ 'min_price', 'max_price' ];

	/**
	 * Inject an instance of the service and store it for reference.
	 *
	 * @param CompareProductService $CompareProductsService
	 *
	 * @internal param $compare_products_service
	 */
	public function __construct(CompareProductService $CompareProductsService)
	{
		$this->compare_products_service = $CompareProductsService;
	}

	/**
	 * Retrieves all comparison products.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int                      $page
	 * @param int                      $limit
	 *
	 * @return mixed results of JSON objects.
	 */
	public function index(Request $request, $page = 1, $limit = 15)
	{
		$parameters = Input::get(); // Returns the parameters in an array.

		$search_params = [];

		$Search_Name = "";
		if ( isset( $parameters[ 'search' ] ) && ! empty( $parameters[ 'search' ] ) ) {
			$Search_Name = $parameters[ 'search' ];
		}

		$category_id = "";
		if ( isset( $parameters[ 'category_id' ] ) && ! empty( $parameters[ 'category_id' ] ) ) {
			$category_id = $parameters[ 'category_id' ];
		}

        $sc_id = "";
		if ( isset( $parameters[ 'sc_id' ] ) && ! empty( $parameters[ 'sc_id' ] ) ) {
            $sc_id = $parameters[ 'sc_id' ];
		}

		$min_price = "";
		if ( isset( $parameters[ 'min_price' ] ) && ! empty( $parameters[ 'min_price' ] ) ) {
			$min_price = $parameters[ 'min_price' ];
		}

		$max_price = "";
		if ( isset( $parameters[ 'max_price' ] ) && ! empty( $parameters[ 'max_price' ] ) ) {
			$max_price = $parameters[ 'max_price' ];
		}

		//=================Filter Specs Section ==================//
		$Filters = [];
		foreach ( $parameters as $Filter_key => $Filter_value_raw ) {
			if ( strpos( $Filter_key, 'f_' ) !== false ) {
				$Filter_Name             = explode( 'f_', $Filter_key )[ 1 ];
				$Filter_values           = explode( ',', $Filter_value_raw );
				$Filters[ $Filter_Name ] = $Filter_values;
			}
		}
		$Filters_range = [];
		foreach ( $parameters as $Filter_key => $Filter_value_raw ) {
			if ( strpos( $Filter_key, 'fr_' ) !== false ) {
				$Filter_Name             = explode( 'fr_', $Filter_key )[ 1 ];
				$Filter_values           = explode( '-', $Filter_value_raw );
				$Filters_range[ $Filter_Name ] = $Filter_values;
			}
		}

		//==========End of Filter Specs Section ==================//
		$products = new CompareProduct;
		if ( ! empty( $Search_Name ) ) {
			$products = $products->where( 'name', 'LIKE', "%$Search_Name%" );
		}
		if ( ! empty( $category_id ) ) {
			$products = $products->where( 'category', '=', $category_id );
		}
		if ( ! empty( $sc_id ) ) {
			$products = $products->where( 'sc_id', 'like', $sc_id );
		}
		if ( ! empty( $min_price ) ) {
			$products = $products->where( 'min_price', '>=', $min_price );
		}
		if ( ! empty( $max_price ) ) {
			$products = $products->where( 'min_price', '<=', $max_price );
		}
		if ( ! empty( $Filters ) ) {
			$specs = [];
			foreach ( $Filters as $Fkey => $Fvalue ) {
				$specs_sub_ids = new Compare_detail;
				foreach ( $Fvalue as $f_key => $f_value ) {
					if ( $f_key == 0 ) {
						$specs_sub_ids = $specs_sub_ids->where( 'detail_code', 'LIKE', $Fkey );
						$specs_sub_ids = $specs_sub_ids->where( 'detail_value', 'LIKE', '%' . $f_value . '%' );
					} else {
						$specs_sub_ids = $specs_sub_ids->orWhere( 'detail_code', 'LIKE', $Fkey );
						$specs_sub_ids = $specs_sub_ids->where( 'detail_value', 'LIKE', '%' . $f_value . '%' );
					}
				}
				$specs_sub_ids = $specs_sub_ids->pluck( 'compare_product_id' );
				$products      = $products->whereIn( 'id', $specs_sub_ids );
			}

		}

		if ( ! empty( $Filters_range ) ) {
			$specs = [];
			foreach ( $Filters_range as $Fkey => $Fvalue ) {
				// dd($Fkey);
				$specs_sub_ids = new Compare_detail;
					$specs_sub_ids = $specs_sub_ids->where( 'detail_code', 'LIKE', $Fkey );

				$specs_sub_full = $specs_sub_ids->get()->toArray();
				$values = [];
				$ids = [];
				foreach ($specs_sub_full as $key => $value) {
					
					$db_val = floatval($value["detail_value"]);
					if($Fvalue[0] <= $db_val  && $db_val <= $Fvalue[1]){
						$values[$value["compare_product_id"]] = floatval($value["detail_value"]);
						$ids[] = $value["compare_product_id"];
					}
				}
				$specs_sub_ids = $specs_sub_ids->pluck( 'compare_product_id' );
				 // dd($values);
				$products      = $products->whereIn( 'id', $ids );
			}

		}
		

		//Sorting
		if ( isset( $parameters[ 'ordering' ] ) && ! empty( $parameters[ 'ordering' ] ) ) {
			if ( trim( $parameters[ 'ordering' ] ) == "min_price" ) {
				$products = $products->orderBy( 'min_price', 'asc' );
			}
			if ( trim( $parameters[ 'ordering' ] ) == "max_price" ) {
				$products = $products->orderBy( 'min_price', 'desc' );
			}
		}

		$products = $products->select('id', 'name', 'model_number', 'category', 'category as category_id', 'price', 'min_price', 'max_price', 'rating', 'retailers', 'image', 'posted_timestamp', 'sc_id', 'merchant_id', 'product_id', 'retailer_product_id')->get()->toArray();
		// $products = $products->with('product_compare_specs')->paginate();
		//-=============PAGINATION=============//
		// Set the request params.
		// Get the current page or default to 1
		$page  = Input::get( 'page', $page );
		$limit = Input::get( 'limit', $limit );;
		$offset = ( $page * $limit ) - $limit;

		return new LengthAwarePaginator( array_slice( $products, $offset, $limit, true ), count( $products ), $limit, $page, [ 'path' => $request->url(), 'query' => $request->query() ] );


		return $products->jsonSerialize();


	}

	/**
	 * Retrieve a single product.
	 *
	 * @param $id
	 *
	 * @return mixed
	 */
	public function show($id)
	{
		$product = CompareProduct::where( 'id', $id )->firstOrFail();
		return $product->jsonSerialize();
	}

	protected function filterThrough($params)
	{

	}


}
