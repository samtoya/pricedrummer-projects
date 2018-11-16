<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Retailer;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;

class RetailersController extends Controller
{
	public function index(Request $request, $page = 1, $limit = 15)
	{
		$retailers = new Retailer();
		$retailers = $retailers->select('id', 'merchant_ID', 'merchant_ID as merchant_id', 'company_name', 'registration_number', 'shop_address', 'telephone1', 'telephone2', 'email', 'country', 'city', 'site_url', 'account_status', 'posted_timestanp')->get()->toArray();

		// $products = $products->with('product_compare_specs')->paginate();
		//-=============PAGINATION=============//
		// Set the request params.
		// Get the current page or default to 1
		$page  = Input::get( 'page', $page );
		$limit = Input::get( 'limit', $limit );;
		$offset = ( $page * $limit ) - $limit;

		return new LengthAwarePaginator( array_slice( $retailers, $offset, $limit, true ), count( $retailers ), $limit, $page, [ 'path' => $request->url(), 'query' => $request->query() ] );


		return $retailers->jsonSerialize();
    }

	public function show($id)
	{
		$retailer = Retailer::select('id', 'merchant_ID', 'merchant_ID as merchant_id', 'company_name', 'registration_number', 'shop_address', 'telephone1', 'telephone2', 'email', 'country', 'city', 'site_url', 'account_status', 'posted_timestanp')->where('id', $id)->firstOrFail();
		return $retailer->jsonSerialize();
    }
}
