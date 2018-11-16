<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Sc;
use App\ScDetail;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;

class FilterController extends Controller
{
	public function search( $search = "" )
	{
		$search_param = Input::get( 'search', $search );

		$data               = fetch_data( '/api/v1/productcompare/?search=' . $search_param . '&limit=3' );
		$SampleSearchResult = $data->data;

		if ( count( $SampleSearchResult ) == 1 ) {
			// take the user to the compare page if there is only one search result
			$category   = $SampleSearchResult[ 0 ]->category_id;
			$compare_id = $SampleSearchResult[ 0 ]->id;
			$sc_id      = $SampleSearchResult[ 0 ]->sc_id;
			$new_url    = "/compare/" . $sc_id . "/" . $compare_id;
			header( 'Location: ' . $new_url );
			exit;

		} elseif ( count( $SampleSearchResult ) > 1 ) {
			// take the user to the filter page if there was more than one search result
			$category = $SampleSearchResult[ 0 ]->category_id;
			$new_url  = "/filter/" . $category . "/search?search=" . urlencode( $search_param );
			header( 'Location: ' . $new_url );
			exit;

		} else {
			// take the user to the product not found page if there was nothing found for the search parameter
			$new_url = "/s/" . urlencode( $search_param );
			header( 'Location: ' . $new_url );
			exit;
		}

	}


	public function search_not_found( $search_param )
	{
//		dd( $search_param );

        //Collect the home page static json quick categories
        $home_quick_categories = fetchJSON('home_quick_categories');

        return view('pages.static.search_result', compact('search_param','home_quick_categories') );
	}

	private function breadcrumbs( $category_id )
	{
		$data = fetch_data( '/api/v1/categories/' . $category_id );
		return prepare_breadcrumb_levels( $data );
	}

	public function index( $id, $category_name, $page = 1, $limit = 21, $view = 'grid' )
	{

		$page  = Input::get( 'page', $page );
		$limit = Input::get( 'limit', $limit );
		$view  = Input::get( 'view', $view );

		$all_query_params = Input::get();

		$search_string = "";

		$MatchingCategories = [];
		$RelatedCategories  = [];
		if ( isset( $all_query_params[ 'search' ] ) ) {
			$search_param     = $all_query_params[ 'search' ];
			$data             = fetch_data( '/api/v1/categories/?xsearch=' . $search_param );
			$SearchCategories = $data->data;

			//build search string
			$search_string = "&search=" . $search_param;

			//Find matching categories and related categories
			foreach ( $SearchCategories as $key => $category ) {
				if ( $category->level > 2 && $category->has_product == 1 ) {
					$catdata          = fetch_data( '/api/v1/productcompare/?category_id=' . $category->category_id . "&search=" . $search_param . "&limit=2" );
					$SearchCategories = $catdata->data;
					if ( count( $SearchCategories ) > 0 && $category->category_id != $id ) {
						$MatchingCategories[] = $category;
					}
				}

				if ( $category->level == 3 && $category->has_product == 1 ) {
					$catdata = fetch_data( '/api/v1/categories/?parent_id=' . $category->category_id );
					if ( ! empty( $catdata ) ) {
						$SearchCategories = $catdata->data;
						if ( count( $SearchCategories ) > 0 && $category->category_id != $id ) {
							$RelatedCategories[] = $category;
						}
					}

				}
			}

		}

		$filter_string = "&";
		foreach ( $all_query_params as $filter_key => $filter_value ) {
			if ( strpos( $filter_key, 'f_' ) !== false or strpos( $filter_key, 'fr_' ) !== false ) {
				$new_filter_value = urldecode( $filter_value );
				$filter_string    = $filter_string . str_replace( '_', '.', $filter_key ) . "=" . $new_filter_value . "&";

			}else{
                $new_filter_value = urldecode( $filter_value );
                $filter_string    = $filter_string . $filter_key . "=" . $new_filter_value . "&";
            }
		}

		//Fetch all the level one form the api
		$data                  = fetch_data( '/api/v1/productcompare/?category_id=' . $id . '&limit=' . $limit . '&page=' . $page . '&view=' . $view . $search_string . $filter_string );
		$compare_products      = $data->data;
		$compare_products_data = $data;

		foreach ( $compare_products as $key => $compare_product ) {
			$Number_of_Prices = 0;

			$isMerchantProduct         = 0;
			$isRetailerProduct         = 0;
			$isBothMerchantAndRetailer = 0;

			$merchants_products = $compare_product->product_id;
			$retailer_products  = $compare_product->retailer_product_id;

			//Prepare Merchant Products Count to set prices
			if ( ! empty( $merchants_products ) ) {
				//there is a merchant product
				$merchant_product_splited = explode( ',', $merchants_products );
				if ( count( $merchant_product_splited ) < 2 ) {    //Merchant products are less than two
					if ( trim( $merchant_product_splited[ 0 ] != '' ) ) {
						$Number_of_Prices  = $Number_of_Prices + 1;
						$isMerchantProduct = 1;
					}
				} else { //Merchant product is more than two
					$Number_of_Prices  = $Number_of_Prices + count( $merchant_product_splited );
					$isMerchantProduct = 1;
				}

			} else {
				//there is no merchant product
			}

			//Prepare Retailer Products Count to set prices
			if ( ! empty( $retailer_products ) ) {
				//there is a merchant product
				$retailer_product_splited = explode( ',', $retailer_products );
				if ( count( $retailer_product_splited ) < 2 ) {    //Merchant products are less than two
					if ( trim( $retailer_product_splited[ 0 ] != '' ) ) {
						$Number_of_Prices  = $Number_of_Prices + 1;
						$isRetailerProduct = 1;
					}
				} else { //Merchant product is more than two
					$Number_of_Prices  = $Number_of_Prices + count( $retailer_product_splited );
					$isRetailerProduct = 1;
				}

			} else {
				//there is no merchant product
			}

			//Check and set isBothMerchantAndRetailer to 1 if there is both a merchant and a retailer product
			if ( $isMerchantProduct != 0 && $isRetailerProduct != 0 ) {
				$isBothMerchantAndRetailer = 1;
				//empty both isMerchantProduct and isRetailerProduct to prevent the ui from displaying them
				$isMerchantProduct = 0;
				$isRetailerProduct = 0;
			}

			//Add the new prepared values to the compare_product object
			$compare_product->prices_count              = $Number_of_Prices;
			$compare_product->isMerchantProduct         = $isMerchantProduct;
			$compare_product->isRetailerProduct         = $isRetailerProduct;
			$compare_product->isBothMerchantAndRetailer = $isBothMerchantAndRetailer;

			if ( $Number_of_Prices == 1 && $isMerchantProduct == 1 ) {
				$Product_id = explode( ',', $compare_product->product_id )[ 0 ];

				$product_data = fetch_data( '/api/v1/products/' . $Product_id . '/' );
				//dd($product_data );
				if ( ! empty( $product_data ) ) {
					$compare_product->url = $product_data->url;

					$compare_url                    = "/compare/" . $compare_product->sc_id . "/" . $compare_product->id;
					$compare_product->compare_url   = $compare_url;
					$compare_product->merchant_logo = $product_data->merchant_id;
				} else {
					$compare_product->url           = "";
					$compare_product->compare_url   = "";
					$compare_product->merchant_logo = "";
				}
			} else if ( $Number_of_Prices == 1 && $isRetailerProduct == 1 ) {
				$compare_url                  = "/contact_seller/" . $compare_product->sc_id . "/" . $compare_product->retailer_product_id;
				$compare_product->url         = $compare_url;
				$compare_url_actual           = "/compare/" . $compare_product->sc_id . "/" . $compare_product->id;
				$compare_product->compare_url = $compare_url_actual;

			} else if ( $Number_of_Prices > 1 && $isBothMerchantAndRetailer == 1
			            || $Number_of_Prices > 1 && $isMerchantProduct == 1
			            || $Number_of_Prices > 1 && $isRetailerProduct == 1
			) {
				$compare_url                  = "/compare/" . $compare_product->sc_id . "/" . $compare_product->id;
				$compare_product->url         = $compare_url;
				$compare_product->compare_url = $compare_url;
			}

		} //End of foreach cpmpare product loop


		//================Price Rage Values Section=================//
		$min_price_data = fetch_data( '/api/v1/productcompare/?category_id=' . $id . '&ordering=min_price&limit=1' );
		$min_price      = 0;
		if ( count( $min_price_data->data ) > 0 ) {
			$min_price = $min_price_data->data[ 0 ]->min_price;
		}

		$max_price_data = fetch_data( '/api/v1/productcompare/?category_id=' . $id . '&ordering=max_price&limit=1' );
		$max_price      = 0;
		if ( count( $max_price_data->data ) > 0 ) {
			$max_price = $max_price_data->data[ 0 ]->max_price;
		}

		//================Category Filters Values Section=================//
		$category_data        = fetch_data( '/api/v1/categories/' . $id . '/' );
		$category_details_raw = $category_data->category_detail;
		$category_details     = [];

		$RANGE_CODES = [
			'DISPLAY',
			'WEIGHT',
			'WIDTH',
			'WIDHT',
			'SCREEN_SIZE',
			'HEIGHT',
			'INTERNAL_STORAGE',
			'RAM',
			'SPIN_SPEED',
			'CAPACITY',
			'DEPTH',
			'SPEAKER_WIDTH',
			'AUTOFOCUS_POINTS',
			'MAX_RESOLUTION',
			'OPTICAL_ZOOM',
			'PHOTO_SENSOR_SIZE',
			'RAM_SIZE',
			'BATTERY_LIFE',
			'HARD_DRIVE_SIZE',
			'CPU_SPEED',
			'FLASH_SIZE',
			'DISPLAY_SIZE',
		];

		$REMOVE_FIELDS = [ 'MODEL', 'VIDEO_LINK' ];

		//Re-arrange the sepc filters by the order_index field  2197C9
		usort( $category_details_raw, function ( $a, $b ) {
			return strcmp( $a->order_index, $b->order_index );
		} );

		// dd($category_details_raw);

		foreach ( $category_details_raw as $key => $category_detail ) {
			// echo $category_detail->detail_code;
			$detail_key      = trim( $category_detail->detail_code );
			$Unit_of_measure = '-' . trim( $category_detail->suggestion );
			if ( in_array( $detail_key, $RANGE_CODES ) ) {
				$detail_key = $detail_key . '|range' . $Unit_of_measure;
			}

			if ( ! in_array( $detail_key, $REMOVE_FIELDS ) ) {
				$category_details[ $detail_key ] = [];
			}


		}

		$sc_ids     = new Sc;
		$sc_ids     = $sc_ids->select( 'sc_ID' )->where( 'category_ID', '=', $id )->pluck( 'sc_ID' );
		$sc_details = new ScDetail;
		$sc_details = $sc_details->where( 'info_type', '=', 'COMPULSORY' )->where( 'details_value', '<>', 'N/A' )->where( 'details_value', '<>', '' )->whereIn( 'product_ID', $sc_ids )->get()->toArray();
		// dd($sc_details);
		foreach ( $sc_details as $sc_detail_key => $sc_detail_value ) {
			//check if the code is exist in the base specs

			$detail_code     = trim( $sc_detail_value[ 'details_code' ] );
			$Unit_of_measure = '';
			//go through the category datails data retured above to collect the unit of messure(suggestion)
			foreach ( $category_details_raw as $key => $category_detail ) {
				if ( trim( $category_detail->detail_code ) == $detail_code ) {
					$Unit_of_measure = '-' . trim( $category_detail->suggestion );
					break;
				}
			}

			$details_value = trim( $sc_detail_value[ 'details_value' ] );

			if ( in_array( $detail_code, $RANGE_CODES ) ) {
				$detail_code   = $detail_code . '|range' . $Unit_of_measure;
				$details_value = round( floatval( $details_value ), 2 );
			}

			if ( array_key_exists( $detail_code, $category_details ) ) { //if the code is in the base spec
				//split values if they are pipe separated
				if ( strpos( $details_value, '|' ) !== false ) {
					foreach ( explode( '|', $details_value ) as $value ) {
						$category_details[ $detail_code ][] = $value;
					}
				} else {//else assign the values as they are
					$category_details[ $detail_code ][] = $details_value;
				}
			}
		}
		//  dd($category_details);
		foreach ( $category_details as $base_key => $base_value ) {
			sort( $base_value );
			$category_details[ $base_key ] = array_filter( array_unique( $base_value ) );
		}
		// dd($category_details);


		//================Buying Guide Section=================//
		$buying_guide_data = fetch_data( '/api/v1/guide/?category_id=' . $id . '&limit=1000' );
		$buyers_guide      = $buying_guide_data->data;


		//================View Return Section=================//
		if ( $view == 'list' ) {
			//Return the list view
			$view = 'list';
		} else if ( $view == 'grid' ) {
			//return the grid view
			$view == 'grid';
		} else {
			$view == 'grid';
		}

		// Breadcrumb
		$breadcrumbs = $this->breadcrumbs( $id );

		//Remove all entries with empty values
		$category_details = remove_empty( $category_details );
		$category_name    = ucfirst( str_replace( '-', ' ', $category_name ) );
		// dd($emptyRemoved);
		$current_category = $id;

//		dd( $compare_products);

		return view( 'pages.dynamic.filter',
			compact( 'compare_products',
				'compare_products_data',
				'min_price',
				'max_price',
				'category_details',
				'buyers_guide',
				'MatchingCategories',
				'RelatedCategories',
				'current_category',
				'category_name',
				'breadcrumbs',
				'view' ) );

		/*	if($view == 'l'){

				//Return the list view
				return view('pages.dynamic.filter', compact('compare_products','compare_products_data') );

			}else if($view == 'g'){

				//return the grid view
				return view('pages.dynamic.filter_grid', compact('compare_products','compare_products_data') );
			}*/
		//============End of View Return Section============//

	}
}
