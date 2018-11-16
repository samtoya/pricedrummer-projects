<?php

namespace App\Http\Controllers;

use App\Retailer;
use App\RetailerProduct;
use Illuminate\Http\Request;

class RetailerProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rp = RetailerProduct::paginate();
        return $rp->jsonSerialize();
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
