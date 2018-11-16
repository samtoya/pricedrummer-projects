<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\BuyingGuideService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

class BuyingGuideController extends Controller
{
	/**
	 * Stores an instance of the BuyingGuideService.
	 * @var BuyingGuideService
	 */
	protected $guides;

	/**
	 * BuyingGuideController constructor.
	 * Inject the BuyingGuideService and store it for use.
	 *
	 * @param BuyingGuideService $guide_service
	 *
	 * @internal param $guides
	 */
	public function __construct(BuyingGuideService $guide_service)
	{
		$this->guides = $guide_service;
	}


	public function index(Request $request, $page=1,$limit=15)
	{
		$data = $this->guides->getGuides();
//		return response()->json($data);

		// Set the request params.
		// Get the current page or default to 1
		$page = Input::get('page', $page);
		$limit = Input::get('limit', $limit);;
		$offset = ($page * $limit) - $limit;

		return new LengthAwarePaginator(array_slice($data, $offset, $limit, true), count($data), $limit, $page, ['path' => $request->url(), 'query' => $request->query()]);

//		$guide = BuyingGuide::paginate();
//		return $guide->jsonSerialize();
	}
}
