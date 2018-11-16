<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class CompareController extends Controller
{
	public function index($sc_id, $product_id)
	{
		$scimages = fetch_data( "/api/v1/scimages?product_id=" . $sc_id );

		$product_images = $scimages->data;
		$total_images = count($scimages->data);

		$sc_data = fetch_data( "/api/v1/sc/" . $sc_id ); 
		$product = $sc_data;

		$data = fetch_data( "/api/v1/productcompare/?sc_id=" . $sc_id );
		$compare_product = $data->data[0];

		$Number_of_Prices = 0;
		$isMerchantProduct = 0;
        $isRetailerProduct = 0;
        $isBothMerchantAndRetailer = 0;
        $product_retailers = [];

        $merchants_products = $compare_product->product_id;
        $retailer_products = $compare_product->retailer_product_id;

        //Prepare Merchant Products Count to set prices
        if(!empty($merchants_products)){
        	//there is a merchant product
        	$merchant_product_splited = explode(',', $merchants_products);
        	if(count($merchant_product_splited) < 2){	//Merchant products are less than two
        		if( trim($merchant_product_splited[0] != '') ){
        			$Number_of_Prices = $Number_of_Prices+1;
                    $isMerchantProduct = 1;

                    // dd( $merchant_product_splited );

        		}
        	}else{ //Merchant product is more than two
        		$Number_of_Prices = $Number_of_Prices + count($merchant_product_splited);
                $isMerchantProduct=1;

                foreach ($merchant_product_splited as $product_id) {
                	$retailer_product_info = fetch_data( '/api/v1/products/' . $product_id );

                	// dd( $retailer_product_info );

                	$retailer_product_info->rating = 0;
                	$retailer_product_info->is_offline = 0;

                	$product_retailers[] = $retailer_product_info;
                }
        	}

        } else {
        	//there is no merchant product
        }

        //Prepare Retailer Products Count to set prices
        if(!empty($retailer_products)){
        	//there is a merchant product
        	$retailer_product_splited = explode(',', $retailer_products);
        	if(count($retailer_product_splited) < 2){	//Merchant products are less than two
        		if( trim($retailer_product_splited[0] != '') ){
        			$Number_of_Prices = $Number_of_Prices+1;
                    $isRetailerProduct = 1;
        		}
        	} else { //Merchant product is more than two
        		$Number_of_Prices = $Number_of_Prices + count($retailer_product_splited);
                $isRetailerProduct=1;

                foreach( $retailer_product_splited as $retailer_product_id ) {
                	$retailer_product_info = fetch_data( '/api/v1/retailer_products/' . $retailer_product_id );

                	$retailer_product_info->rating = 0;
                	$retailer_product_info->is_offline = 1;
                	$retailer_product_info->url = "/contact_seller/" . $sc_id . "/" . $retailer_product_id;

                	$product_retailers[] = usort($retailer_product_info, "cmp");
                }
        	}

        }else{
        	//there is no merchant product
        }

        //Check and set isBothMerchantAndRetailer to 1 if there is both a merchant and a retailer product
        if($isMerchantProduct != 0 && $isRetailerProduct != 0){
            $isBothMerchantAndRetailer = 1;
            //empty both isMerchantProduct and isRetailerProduct to prevent the ui from displaying them
            $isMerchantProduct = 0;
            $isRetailerProduct = 0;
        }

        //Add the new prepared values to the compare_product object
        $compare_product->prices_count = $Number_of_Prices;
        $compare_product->isMerchantProduct = $isMerchantProduct;
        $compare_product->isRetailerProduct = $isRetailerProduct;
        $compare_product->isBothMerchantAndRetailer = $isBothMerchantAndRetailer;

        if($Number_of_Prices ==1 && $isMerchantProduct==1){
        	$Product_id = explode(',', $compare_product->product_id)[0];

        	$product_data = fetch_data('/api/v1/products/'.$Product_id.'/');
        	//dd($product_data );
        	if(!empty($product_data)){
        		$compare_product->url = $product_data->url;

        		$compare_url = "/compare/".$compare_product->sc_id. "/" .$compare_product->id;
                $compare_product->compare_url = $compare_url;
                $compare_product->merchant_logo = $product_data->merchant_id;
        	}else{
        		$compare_product->url = "";
        		$compare_product->compare_url = "";
                $compare_product->merchant_logo = "";
        	}
        }else if($Number_of_Prices ==1 && $isRetailerProduct == 1){
            $compare_url = "/contact_seller/" . $compare_product->sc_id . "/" . $compare_product->retailer_product_id;
            $compare_product->url = $compare_url;
            $compare_url_actual = "/compare/" . $compare_product->sc_id . "/" . $compare_product->id;
            $compare_product->compare_url = $compare_url_actual;

        }else if($Number_of_Prices > 1 && $isBothMerchantAndRetailer==1
                ||$Number_of_Prices > 1 && $isMerchantProduct==1
                ||$Number_of_Prices > 1 && $isRetailerProduct==1 ){
            $compare_url = "/compare/" . $compare_product->sc_id . "/" . $compare_product->id;
            $compare_product->url = $compare_url;
            $compare_product->compare_url = $compare_url;
        }

        // dd( $product_retailers );
        // dd( $product_images );
        // dd( $compare_product );

        $product_video_link = "";

        foreach($product->sc_detail as $spec) {
            if (trim($spec->details_code) == "VIDEO_LINK") {
                $product_video_link = $spec->details_value;
                break;
            }
        }

        $breadcrumbs = $this->breadcrumbs( $compare_product->category_id );
        
        usort( $product_retailers, function( $key, $value ) {
            return strcmp( $key->price, $value->price );
        });


        return view('pages.dynamic.compare')
			->with('product', $product)
			->with('breadcrumbs', $breadcrumbs)
			->with('product_images', $product_images)
			->with( 'products_retailers', $product_retailers )
			->with( 'total_images', $total_images )
			->with( 'product_video_link', $product_video_link )
			->with( 'compare_product', $compare_product );
	}

	private function breadcrumbs( $category_id )
	{
		$data = fetch_data( '/api/v1/categories/' . $category_id );
		return prepare_breadcrumb_levels( $data );
	}
}
