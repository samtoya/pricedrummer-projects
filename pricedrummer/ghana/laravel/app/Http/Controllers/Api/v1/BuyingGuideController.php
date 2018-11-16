<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BuyingGuideService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use App\BuyingGuide;

class BuyingGuideController extends Controller
{

	public function index(Request $request, $page=1,$limit=15)
	{

//		return response()->json($data);

        $params = Input::get();

        $category_id = "";
        if ( ! empty( $params[ 'category_id' ] ) ) {
            $category_id = $params[ 'category_id' ];
        }

        $guides = BuyingGuide::select( 'id', 'heading', 'content', 'image_alt_text', 'has_image', 'category_ID');

        if ( ! empty( $category_id ) ) {
            $guides = $guides->where( 'category_ID', '=', $category_id );
        }

        $guides = $guides->get()->toArray();

        // Set the request params.
        // Get the current page or default to 1
        $page = Input::get('page', $page);
        $limit = Input::get('limit', $limit);;
        $offset = ($page * $limit) - $limit;

        return new LengthAwarePaginator(array_slice($guides, $offset, $limit, true), count($guides), $limit, $page, ['path' => $request->url(), 'query' => $request->query()]);

//		$guide = BuyingGuide::paginate();
//		return $guide->jsonSerialize();
    }
}
