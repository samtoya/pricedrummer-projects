<?php

namespace App\Http\Controllers;

use App\ScImage;
use App\Services\ScImageService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ScImagesController extends Controller {
	protected $sc_image;

	/**
	 * ScImagesController constructor.
	 *
	 * @param ScImageService $sc_image_service
	 */
	public function __construct( ScImageService $sc_image_service ) {
		$this->sc_image = $sc_image_service;
	}

	public function index( Request $request, $page = 1, $limit = 15 ) {
		$parameters = Input::get(); // Returns the parameters in an array.

		$product_id = "";
		if ( isset( $parameters[ 'product_id' ] ) && ! empty( $parameters[ 'product_id' ] ) ) {
			$product_id = $parameters[ 'product_id' ];
		}
//		$image_id = "";
//		if ( isset( $parameters[ 'image_id' ] ) && ! empty( $parameters[ 'image_id' ] ) ) {
//			$image_id = $parameters[ 'image_id' ];
//		}
		$data = new ScImage();
//		$data = ScImage::select('image_ID', 'product_ID')->get();

		if ( ! empty( $product_id ) ) {
			$data = $data->where( 'product_ID', $product_id );
		}
		$data = $data->select('image_ID as image_id', 'product_ID as product_id')->get()->toArray();

		$page  = Input::get( 'page', $page );
		$limit = Input::get( 'limit', $limit );;
		$offset = ( $page * $limit ) - $limit;

		return new LengthAwarePaginator( array_slice( $data, $offset, $limit, true ), count( $data ), $limit, $page, [
			'path'  => $request->url(),
			'query' => $request->query(),
		] );
	}
}
