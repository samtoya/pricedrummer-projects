<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchant;
use App\Services\MerchantService;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;


class MerchantsController extends Controller
{
	protected $merchant;

	/**
	 * MerchantsController constructor.
	 *
	 * @param MerchantService $Merchant
	 */
	public function __construct(MerchantService $Merchant)
	{
		$this->merchant = $Merchant;
	}

	/**
	 * @param Request $request
	 * @param int     $page
	 * @param int     $limit
	 *
	 * @return LengthAwarePaginator
	 */
    public function index(Request $request, $page=1,$limit=15)
    {
    	$data = $this->merchant->getMerchants();

	    // Set the request params.
	    // Get the current page or default to 1
   		$page = Input::get('page', $page);
		$limit = Input::get('limit', $limit);;
		$offset = ($page * $limit) - $limit;

		return new LengthAwarePaginator(array_slice($data, $offset, $limit, true), count($data), $limit, $page, ['path' => $request->url(), 'query' => $request->query()]);
    }

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
    public function show($id)
    {
    	$merchant = Merchant::where('merchant_ID', $id)->firstOrFail();
    	return $merchant->jsonSerialize();
    }
}
