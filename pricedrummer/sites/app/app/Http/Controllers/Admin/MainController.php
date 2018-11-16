<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Merchant;
use App\Retailer;
use Illuminate\Support\Facades\DB;
use DateTime;

class MainController extends Controller
{

    public function index()
    {
        return view('pages.admin.index');
    }

    public function invoices()
    {
        return view('pages.admin.invoices');
    }

    public function chooseMerchant()
    {
        $Customer_details = [];

        $Merchants = Merchant::all()->toArray();

        foreach ($Merchants as $merchant){
            if(!empty($merchant)){
                $Customer_details[] = [
                    'id' => $merchant['merchant_ID'],
                    'name' => $merchant['name']
                ];
            }
        }
        return view('pages.admin.choose_range')
            ->with('customer_type','merchant_ID')
            ->with('Customer_details',$Customer_details);
    }

    public function chooseRetailer()
    {
        $Retailers = Retailer::all()->toArray();
        foreach ($Retailers as $retailer){
            if(!empty($retailer)){
                $Customer_details[] = [
                    'id' => $retailer['id'],
                    'name' => $retailer['company_name']
                ];
            }
        }
        return view('pages.admin.choose_range')
            ->with('customer_type','id')
            ->with('Customer_details',$Customer_details);
    }

    public function chooseBoth()
    {
        return view('pages.admin.choose_range')
            ->with('customer_type','both');
    }

    public function collectInvoice( Request $request )
    {
        $invoices = DB::table('retailer_invoice_trail');
        if ( ! empty( $request->get('id')) ) {
            $id = $request->get('id');
            if($id == 'all'){
                $invoices = $invoices->whereNotNull('retailer_id');
            }else{
                $invoices = $invoices->where('retailer_id', $id);
            }
        }
        if ( !empty($request->get('merchant_ID')) ) {
            $id = $request->get('merchant_ID');
            if($id == 'all'){
                $invoices = $invoices->whereNotNull('merchant_id');
            }else{
                $invoices = $invoices->where('merchant_id', $id);
            }
        }
        $invoices = $invoices->whereDate('posted_timestamp', '>=' , new DateTime($request->get('date_from')));
        $invoices = $invoices->whereDate('posted_timestamp', '<=' , new DateTime($request->get('date_to')));


        $invoices = $invoices->get()->toArray();

//        dd( $invoices );
        return view('pages.admin.invoices', compact('invoices'));
    }

    public function collectInvoice_both( Request $request )
    {
        $invoices = DB::table('retailer_invoice_trail');
        $invoices = $invoices->where('invoice_type', 'ITEM_CLICKED');
        $invoices = $invoices->whereDate('posted_timestamp', '>=' , new DateTime($request->get('date_from')));
        $invoices = $invoices->whereDate('posted_timestamp', '<=' , new DateTime($request->get('date_to')));


        $invoices = $invoices->get()->toArray();

//        dd( $invoices );
        return view('pages.admin.invoices', compact('invoices'));
    }


    public function collectRetailerInvoice(  )
    {

    }
}
