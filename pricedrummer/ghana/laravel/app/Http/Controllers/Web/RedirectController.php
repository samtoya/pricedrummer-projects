<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RedirectController extends Controller
{
	public function index( $product_id )
	{
		$product = fetch_data( '/api/v1/products/' . $product_id );
//		dd( $product );
		return view( 'pages.dynamic.redirect', compact('product') );
	}
}
