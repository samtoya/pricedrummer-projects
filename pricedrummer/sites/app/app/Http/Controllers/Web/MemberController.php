<?php

    namespace App\Http\Controllers\Web;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Input;
    use App\Http\Controllers\Controller;

    class MemberController extends Controller
    {
        public function index( $company_name, $page = 1, $limit = 20 )
        {
            $page  = Input::get( 'page', $page );
            $limit = Input::get( 'limit', $limit );

            $member_name = explode( "-", $company_name );
            $member_name = join( " ", $member_name );
            $member_name = trim( ucwords( $member_name ) );

            $data = fetch_data( '/api/v1/retailers/?name=' . $member_name );

            $retailer_info = $data->data[ 0 ];

            $retailer_products = fetch_data( '/api/v1/retailer_products/?retailer_id=' . $retailer_info->id . '&page=' . $page . '&limit=' . $limit );

            $dummy_phone = substr( $retailer_info->telephone1, 0, 4 );
            $dummy_phone .= "XXX-XXX";

//    		dd($retailer_info);
//    		dd($retailer_products);

            return view( 'pages.dynamic.member_grid' )
                ->with( 'dummy_phone', $dummy_phone )
                ->with( 'retailer_info', $retailer_info )
                ->with( 'retailer_products', $retailer_products );
        }
    }
