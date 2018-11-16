<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
	{

		//Fetch all the level one form the api
		$data = fetch_data('/api/v1/categories/?level=1&limit=1000');
		$categories_raw = $data->data;
		
		//Collect the level 3 categories for the level 1s and add them to the level 1 as category_children 
		$categories=[];
		foreach ($categories_raw as $key => $category) {
			$category_level1_id = $category->category_ID;
			$level3_data = fetch_data('/api/v1/categories/?get_my_3='.$category_level1_id.'&limit=10');
			$category->category_children = $level3_data->data;
			$categories[]=$category;
		}
		// dd($categories);

		$slides = json_decode('[{
								    "id": 471,
								    "image": "img/4.jpg",
								    "name": "Beauty",
								    "url": "http://blog.pricedrummer.com/10-1-must-gadgets-weight-watchers-2017/"
								},{
								    "id": 460,
								    "image": "img/2.jpg",
								    "name": "Sports & Outdoors",
								    "url": "/category/460/sports-&-outdoors"
								}, {
								    "id": 3,
								    "image": "img/3.jpg",
								    "name": "Camera",
								    "url": "/filter/3/camera"
								},{
									"id": 126,
									"image": "img/1.jpg",
								    "name": "Home & Garden",
								    "url": "/category/126/home-&-garden"
								}]');
		// dd($slides);

		//Collect the home page static json quick categories
		$home_quick_categories = fetchJSON('home_quick_categories');
		$top_categories = fetchJSON('top_categories');

		return view( 'pages.index', compact('categories','home_quick_categories','top_categories','slides') );
	}
 



	public function fetch_data($api){
		// Store the original input of the request
		$originalInput = Request::input();

		// Create your request to your API
		$request = Request::create($api, 'GET');
		// Replace the input with your request instance input
		Request::replace($request->input());

		// Dispatch your request instance with the router
		$response = Route::dispatch($request);

		// Fetch the response
		$instance = json_decode(Route::dispatch($request)->getContent());

		// Replace the input again with the original request input.
		Request::replace($originalInput);
		return $instance;
	}

	public function fetchJSON($filename) {
	    $path = storage_path() . "/json/${filename}.json"; // ie: /var/www/laravel/app/storage/json/filename.json
	    if (!File::exists($path)) {
	        throw new Exception("Invalid File");
	    }

	    $file = File::get($path); // string

	    return json_decode($file);

	}
}
