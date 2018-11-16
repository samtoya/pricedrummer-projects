<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductsController extends Controller
{
	public function index(Request $request, $page = 1, $limit = 15)
	{
		$products = new Product();
		$products = $products->select( 'product_ID', 'merchant_ID', 'merchant_ID as merchant_id', 'product_name', 'url', 'video_url', 'category', 'category as category_id', 'status', 'sc_status', 'model_number', 'unique_ID', 'price', 'Image_url', 'Description', 'sc_ID', 'review_timestamp', 'reviewed_by', 'posted_timestamp' )->get()->toArray();


		//-=============PAGINATION=============//
		// Set the request params.
		// Get the current page or default to 1
		$page  = Input::get( 'page', $page );
		$limit = Input::get( 'limit', $limit );;
		$offset = ( $page * $limit ) - $limit;

		return new LengthAwarePaginator( array_slice( $products, $offset, $limit, true ), count( $products ), $limit, $page, [ 'path' => $request->url(), 'query' => $request->query() ] );
	}

	public function show($id)
	{
		$product = Product::where( 'product_id', $id )->select( 'product_ID', 'merchant_ID', 'merchant_ID as merchant_id', 'product_name', 'url', 'video_url', 'category', 'category as category_id', 'status', 'sc_status', 'model_number', 'unique_ID', 'price', 'Image_url', 'Description', 'sc_ID', 'review_timestamp', 'reviewed_by', 'posted_timestamp' )->firstOrFail();
		return $product->jsonSerialize();
	}
}
