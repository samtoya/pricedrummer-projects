<?php
namespace App\Services;


class ContactSellerService
{
	public function getSeller( $product_id )
	{
		$data             = fetch_data( '/api/v1/retailer_products/' . $product_id );
		$retailer_product = $data;

		$ret_data      = fetch_data( '/api/v1/retailers/' . $retailer_product->retailer_id );
		$retailer_info = $ret_data;

		return $retailer_info;
	}
}