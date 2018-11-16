<?php 

namespace App\Services;
use App\Merchant;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

class PaginateDataService {
	public function PaginateData($request, $data , $page=1, $limit=15,)
	{
    	$page = Input::get('page', $page); // Get the current page or default to 1, this is what you miss!
		$limit = Input::get('limit', $limit);
		$offset = ($page * $limit) - $limit;

		return new LengthAwarePaginator(array_slice($data, $offset, $limit, true), count($data), $limit, $page, ['path' => $request->url(), 'query' => $request->query()]);
	}

} 

 ?>