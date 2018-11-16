<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Sc;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ScController extends Controller
{
	/**
	 * Get all sc fields along with sc_detail for all columns.
	 * @return mixed paginated JSON results.
	 */
	public function index(Request $request, $page = 1, $limit = 15)
	{
		$parameters = Input::get(); // Returns the parameters in an array.

		$category_id = "";
		if ( isset( $parameters[ 'category_id' ] ) && ! empty( $parameters[ 'category_id' ] ) ) {
			$category_id = $parameters[ 'category_id' ];
		}

		$scs = new Sc;
		if ( ! empty( $category_id ) ) {
			$scs = $scs->where( 'category_ID', '=', $category_id );
		}
		$scs = $scs->with( 'sc_detail' )->get()->toArray();
//		return response()->json( [
//			'total'        => $scs->getTotal(),
//			'per_page'     => $scs->getPerPage(),
//			'current_page' => $scs->getCurrentPage(),
//			'last_page'    => $scs->getLastPage(),
//			'from'         => $scs->getFrom(),
//			'to'           => $scs->getTo(),
//			"results"      => $scs->jsonSerialize()[ 'data' ]
//		] );

		//-=============PAGINATION=============//
		// Set the request params.
		// Get the current page or default to 1
		$page  = Input::get( 'page', $page );
		$limit = Input::get( 'limit', $limit );;
		$offset = ( $page * $limit ) - $limit;

		return new LengthAwarePaginator( array_slice( $scs, $offset, $limit, true ), count( $scs ), $limit, $page, [ 'path' => $request->url(), 'query' => $request->query() ] );
		
        return $scs->jsonSerialize();
	}

	/**
	 * @param $id
	 *
	 * @return mixed data of JSON object results.
	 */
	public function show($id)
	{
		$sc = Sc::with( 'sc_detail' )->where( 'sc_ID', $id )->firstOrFail();
		return $sc->jsonSerialize();
	}
}
