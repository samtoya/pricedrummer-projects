<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Retailer;
use App\RetailerProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;

class RetailerProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $page = 1, $limit = 15)
    {
        $page  = Input::get( 'page', $page );
        $limit = Input::get( 'limit', $limit );;
        $offset = ( $page * $limit ) - $limit;

        $parameters = Input::get(); // Returns the parameters in an array.
        $retailer_id = "";
        if ( isset( $parameters[ 'retailer_id' ] ) && ! empty( $parameters[ 'retailer_id' ] ) ) {
            $retailer_id = $parameters[ 'retailer_id' ];
        }

        $rp = new RetailerProduct();
        if ( ! empty( $retailer_id ) ) {
            $rp = $rp->where( 'retailer_id', '=', "$retailer_id" );
        }
        $rp = $rp->where('sc_ID','<>','NULL')->with('compare_product')->get()->toArray();
        
        return new LengthAwarePaginator( array_slice( $rp, $offset, $limit, true ), count( $rp ), $limit, $page, [ 'path' => $request->url(), 'query' => $request->query() ] );
        
    }

	/**
	 * Display the specified resource.
	 * @return \Illuminate\Http\Response
	 * @internal param \App\Retailer $retailer
	 */
    public function show($id)
    {
		$rp = RetailerProduct::findOrFail($id);
		return $rp->jsonSerialize();
    }
}
