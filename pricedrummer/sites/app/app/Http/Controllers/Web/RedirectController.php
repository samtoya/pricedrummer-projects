<?php

    namespace App\Http\Controllers\Web;

    use App\Utilities\RandomString;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\DB;

    class RedirectController extends Controller
    {
        public function index( Request $request, $product_id )
        {
            $product = fetch_data( '/api/v1/products/' . $product_id );
            return view( 'pages.dynamic.redirect', compact( 'product' ) );
        }

        public function storeClick( Request $request )
        {
            $click_amount = - 0.1;
            $product      = fetch_data( '/api/v1/products/' . $request->product_id );

            $click_info = [
                'amount'       => $click_amount,
                'user_ip'      => $request->get( 'ip' ),
                'country'      => $request->get( 'country' ),
                'category'     => $product->category_id,
                'product_name' => $product->product_name,
                'doc_number'   => "IC" . RandomString::random20(),
                'compare_url'  => $request->get( 'compare_url' ),
                'merchant_id'  => $product->merchant_id,
                'item_clicked' => $product->url,
                'invoice_type' => 'ITEM_CLICKED',
            ];

//            dd( $click_info );

            $result = DB::table( 'retailer_invoice_trail' )->insert( $click_info );
            echo ( $result ) ? "Done" : "Failed";
        }
    }
