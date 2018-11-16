@extends('layouts.master')

@section('title') @stop

@section('meta')

@stop

@section('content')
    <div class="container" style="margin-top: 20px;">
        <div id="member-area" class="col-md-12 col-lg-12 col-sm-12 col-xs-12 clearfix">
            <div id="member-content" class="col-lg-11 col-mg-11 col-sm-11 col-xs-11">
                <div id="main-area">
                    <div id="member-info" class="col-xs-12 col-md-9 col-sm-9 col-lg-9 clearfix">
                        <div id="member-logo" class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                            <img src="/img/logo.png" alt="">
                            {{-- <img src="http://www.pricedrummer.com/images/static/retailers/ghana/97.jpg" alt=""> --}}
                        </div>

                        <div id="member-company" class="col-lg-7 col-md-7 col-md-7 col-xs-12">
                            <h1>Company Name</h1>
                            <ul>
                                <li>
                                    <i class="fa fa-envelope"></i> 
                                    <a href="mailto:example@domain.com">
                                        example@domain.com
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-globe"></i> 
                                    <a href="www.pricedrummer.com">
                                        www.pricedrummer.com
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-location-arrow"></i>
                                    <span>
                                        Shop Address
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div id="member-details" class="clearfix">
                        <div id="contact-member" class="pull-right">
                            <button>03032XXXXX</button>
                        </div>
                    </div>
                </div>
              </div>
        </div>
    </div>

     <div class="container">
         <div id="ad-header" class="clearfix">
            <p>All ads from Dominion Technologies</p>
            <hr style="width: 10%;  border-color: #11508C;">
        </div>

        <div id="member-products" class="col-md-12 col-xs-12 col-md-12 col-sm-12">
                <div class="row">
                    <div id="member-product" class="col-md-6 col-lg-6 col-sm-6 clearfix">
                    <div id="member-product-image" class="col-md-2 col-sm-2 col-lg-2 col-lg-2">
                        <img src="//placehold.it/400x400" alt="">
                    </div>

                    <div id="member-product-info" class="col-xs-6 col-md-6 col-lg-6 col-sm-6">
                        <h3 class="product-name">Product Name</h3>
                    </div>

                    <div id="member-actions" class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
                        <div class="actions_aling">
                            <span class="pri_range">Min Price</span>
                            <br>
                            <a href="#" class="store">Contact Seller</a>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div id="member-product" class="col-md-6 col-lg-6 col-sm-6 clearfix">
                    <div id="member-product-image" class="col-md-2 col-sm-2 col-lg-2 col-lg-2">
                        <img src="//placehold.it/400x400" alt="">
                    </div>

                    <div id="member-product-info" class="col-xs-6 col-md-6 col-lg-6 col-sm-6">
                        <h3 class="product-name">Product Name</h3>
                    </div>

                    <div id="member-actions" class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
                        <div class="actions_aling">
                            <span class="pri_range">Min Price</span>
                            <br>
                            <a href="#" class="store">Contact Seller</a>
                        </div>
                    </div>
                </div>
                </div>
        </div>
     </div>
@stop

@section('scripts')

@stop