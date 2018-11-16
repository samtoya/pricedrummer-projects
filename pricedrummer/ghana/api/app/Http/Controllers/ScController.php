<?php

namespace App\Http\Controllers;

use App\Sc;
use Illuminate\Http\Response;

class ScController extends Controller
{
	/**
	 * Get all sc fields along with sc_detail for all columns.
	 * @return mixed paginated JSON results.
	 */
	public function index()
	{
		$scs = Sc::with( 'sc_detail' )->paginate();
//		return response()->json( [
//			'total'        => $scs->getTotal(),
//			'per_page'     => $scs->getPerPage(),
//			'current_page' => $scs->getCurrentPage(),
//			'last_page'    => $scs->getLastPage(),
//			'from'         => $scs->getFrom(),
//			'to'           => $scs->getTo(),
//			"results"      => $scs->jsonSerialize()[ 'data' ]
//		] );
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
