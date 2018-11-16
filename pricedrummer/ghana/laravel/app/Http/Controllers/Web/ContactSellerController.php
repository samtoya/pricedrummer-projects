<?php

namespace App\Http\Controllers\Web;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSeller;
use App\Jobs\SendContactSellerEmail;
use Illuminate\Support\Facades\DB;

class ContactSellerController extends Controller
{
	private $queue_time;
	public $seller_info;
	private static $product_id;
	private $retailer_product;
	private static $retailer_id;
	private $subject = "You have an interested buyer";

	/**
	 * ContactSellerController constructor.
	 *
	 * @param \Carbon\Carbon $carbon
	 *
	 * @internal param $queue_time
	 */
	public function __construct( Request $request, Carbon $carbon )
	{
		$this->queue_time = $carbon::now()->addSeconds(10);
	}

	public function index( $sc_id, $product_id )
	{
		$sc_data = fetch_data( '/api/v1/sc/' . $sc_id );
		$product = $sc_data;

		$cp_data         = fetch_data( '/api/v1/productcompare?sc_id=' . $product->sc_ID );
		$compare_product = $cp_data->data[ 0 ];

		$data             = fetch_data( '/api/v1/retailer_products/' . $product_id );
		$retailer_product = $data;

		$ret_data      = fetch_data( '/api/v1/retailers/' . $retailer_product->retailer_id );
		$retailer_info = $ret_data;

//		$ret_prod_images = fetch_data( '/api/v1/retailer_product_images/?retailer_product_id=' . $retailer_product->retailer_id );
//		$product_images = $ret_prod_images;

		return view( 'pages.dynamic.contact_seller' )
			->with( 'compare_product', $compare_product )
			->with( 'retailer_product', $retailer_product )
			->with( 'retailer_info', $retailer_info );
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return string
	 */
	public function mail( Request $request, $retailer_id )
	{
		$this->validate( $request, [
			'inquiry_email'   => 'required|max:100|email',
			'inquiry_message' => 'required',
		] );

		$user_info              = [];
		$email = $user_info[ 'email' ]   = $request->get( 'inquiry_email' );
		$message = $user_info[ 'message' ] = $request->get( 'inquiry_message' );

		$telephone = $user_info['telephone'] = "";
		if ( ( ! empty( $request->get( 'inquiry_number' ) ) ) ) {
			$telephone = $user_info[ 'telephone' ] = $request->get( 'inquiry_number' );
		}

		$copy_flag = $user_info['copy_flag'] = 'false';
		if ( isset( $_POST['inquiry_copy_flag'] ) && $_POST['inquiry_copy_flag'] == 1 ) {
			$copy_flag = $user_info[ 'copy_flag' ] = "true";
		}

		$ret_data      	= fetch_data( '/api/v1/retailers/' . $retailer_id );
		$retailer 		= $ret_data;

		$results = DB::insert("INSERT INTO emails( email_to, email_from, subject, telephone, message, copy_flag ) 
						VALUES( ?,?,?,?,?,? )", [ $retailer->email, $email, $this->subject, $telephone, $message, $copy_flag ]);

		// Mail::send( 'emails.contact',  ['user_info' => $user_info], function ( $message ) use ($user_info) {
		// 	$message->to('admin@pricedrummer.com') // $retailer->email
		// 			->replyTo($user_info['email'])
		// 	        ->subject($this->subject);
		// } );

		// Mail::send( 'emails.contact', ['user_info' => $user_info], function ( $message ) use ($user_info) {
		// 	$message->to('admin@pricedrummer.com') // $retailer->email
		// 			->replyTo($user_info['email'])
		// 	        ->subject($this->subject);
		// 	        // ->queue(new ContactSeller());
		// } );
		
		// Mail::to('admin@pricedrummer.com')
		// 		->later($this->queue_time, new ContactSeller( $user_info ));
				
		// $jobs = ( new SendContactSellerEmail($user_info) )->onConnection('database');

		// dispatch($jobs);

		return back()->withSuccess("Your mail has been sent successfully!");

	}
}
