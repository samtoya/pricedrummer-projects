<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
	public function index($category_id,$category_name)
	{

		//Fetch all the level one form the api
		$data = fetch_data('/api/v1/categoriesl2n3n4/?pcat='.$category_id.'&limit=1000');
		$categories = $data->data;

		$category = fetch_data( '/api/v1/categories/' . $category_id );

		return view('pages.dynamic.category', compact('categories', 'category') );
    }
}
