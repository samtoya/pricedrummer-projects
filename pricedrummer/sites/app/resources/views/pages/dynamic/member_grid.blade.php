@extends('layouts.master')

@section('title') {{ $retailer_info->company_name }} - PriceDrummer Ghana @stop

@section('meta')
    <meta name="keywords"
          content="{{ $retailer_info->company_name }}, compare {{ $retailer_info->company_name }} products, {{ $retailer_info->company_name }} prices, PriceDrummer {{ $country_name }}"/>
    <meta name="description"
          content="Information on {{ $retailer_info->company_name }}. Read user reviews, compare prices and find vouchers and best deals on {{ $retailer_info->company_name }} products on PriceDrummer {{ $country_name }}"/>
@stop

@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="ad-area visible-xs" style="margin: 0 auto -8px;width: 85%;">
                <!-- Advertisement -->
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Mobile Banner 320 x 50 -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:320px;height:50px"
                     data-ad-client="ca-pub-2224646482907163"
                     data-ad-slot="8836011731"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <div id="member-area" class="col-md-12 col-lg-12 col-sm-12 col-xs-12 clearfix">
                <div id="member-content" class="col-lg-11 col-mg-11 col-sm-11 col-xs-11">
                    <div id="main-area">
                        <div id="member-info" class="col-xs-12 col-md-9 col-sm-9 col-lg-9 clearfix">
                            <div id="member-logo" class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                @if($retailer_info)
                                    <img src="http://www.pricedrummer.com/images/static/retailers/ghana/{{ $retailer_info->merchant_id}}.jpg"
                                         alt="{{ $retailer_info->company_name }}"
                                         title="{{ $retailer_info->company_name }}">
                                @else
                                    <img src="{{asset('img/default_avatar.png')}}"
                                         alt="{{$retailer_info->company_name}}"
                                         title="{{$retailer_info->company_name}}">
                                @endif
                            </div>

                            <div id="member-company" class="col-lg-7 col-md-7 col-md-7 col-xs-12">
                                <h1 id="company_name" data-id="retailer-{{ $retailer_info->merchant_id }}"
                                    data-name="{{ $retailer_info->company_name }}">{{ ucwords( $retailer_info->company_name ) }}</h1>
                                <ul>
                                    @if( ! empty( $retailer_info->email ) )
                                        <li>
                                            <i class="fa fa-envelope"></i>
                                            <a target="_blank" title="Contact us via email"
                                               href="mailto:{{ $retailer_info->email }}">
                                                {{ $retailer_info->email }}
                                            </a>
                                        </li>
                                    @endif

                                    @if( ! empty( $retailer_info->site_url ) )
                                        <li>
                                            <i class="fa fa-globe"></i>
                                            <a title="{{ $retailer_info->site_url }}'s website"
                                               href="{{ $retailer_info->site_url }}">
                                                {{ $retailer_info->site_url }}
                                            </a>
                                        </li>
                                    @endif
                                    @if( ! empty( $retailer_info->shop_address ) )
                                        <li>
                                            <i class="fa fa-location-arrow"></i>
                                            <span>
                                            {{ $retailer_info->shop_address }}
                                        </span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div id="member-details" class="col-md-3 col-lg-3 col-sm-3 clearfix">
                            <div id="contact-member" class="pull-right">
                                <button id="contact_info">
                                    {{ $dummy_phone }}
                                </button>
                            </div>
                            <div id="member_number" class="hidden">
                                @if( ! empty( $retailer_info->telephone1 ) )
                                    <button>{{ $retailer_info->telephone1 }}</button>
                                @endif
                                @if( ! empty( $retailer_info->telephone2 ) )
                                    <button>{{ $retailer_info->telephone2 }}</button>
                                @endif
                            </div>
                            {{--<div id="ad_area">--}}
                            {{--<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>--}}
                            {{--<!-- Medium Rectangle - Mobile & Desktop -->--}}
                            {{--<ins class="adsbygoogle"--}}
                            {{--style="display:inline-block;width:300px;height:250px"--}}
                            {{--data-ad-client="ca-pub-2224646482907163"--}}
                            {{--data-ad-slot="1452345733"></ins>--}}
                            {{--<script>--}}
                            {{--(adsbygoogle = window.adsbygoogle || []).push({});--}}
                            {{--</script>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div id="ad-header" class="clearfix">
                <p>All ads from {{ ucwords( $retailer_info->company_name ) }} </p>
                <hr style="width: 10%;  border-color: #11508C;">
            </div>
        </div>

        <div class="row">
            <div id="member-products" class="col-md-12 col-xs-12 col-sm-12">
                @if( ! empty( $retailer_products ) )
                    <div class="member-products-wrapper clearfix">
                        @foreach( $retailer_products->data as $product )
                            <div class="single-product col-md-4 col-xs-6 col-sm-4">
                                <div class="product-image">
                                    <div class="show-img">
                                        <a href="#">
                                            @if(!empty($product->compare_product))
                                            <img src="http://pricedrummer.com/images/static/product_images/thumbs/{{$product->compare_product->image}}.png"
                                                 alt="{{ $product->name }}"
                                                 title="{{ $product->name }}">
                                        @endif
                                        </a>
                                    </div> <!-- end show-img div -->
                                </div> <!-- end product-image div -->
                                <div class="prod-info">
                                    <h2 class="pro-name">
                                        <a target="_blank" href="">{{ $product->name }}</a>
                                    </h2>
                                    <div class="price-box">
                                        <div class="price">
                            <span>
                                {{ $country_currency }}{{ sprintf('%.2f', $product->price) }}
                            </span>
                                        </div>
                                    </div>
                                    <div class="actions">
                        <span class="add-to-cart">
                            <!--If there is only one merchant/retailer then goto store else compare page-->
                                                            <a href="{{url("/contact_seller/" . $product->sc_ID . "/" . $product->id)}}">
                                    <span>Contact Seller</span>
                                </a>

                        </span>
                                    </div>

                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                </div> <!-- end prod-info div -->
                            </div>
                        @endforeach
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12">
                @include('pages.dynamic.shared.filter_pagination', ['compare_products_data' => $retailer_products])
            </div>
        </div>
        @else
            <div class="row">
                <p>No products.</p>
            </div>
        @endif
    </div>
@stop

@section('scripts')
    <script>
        $(function () {
            var member_options = {
                init: function () {
                    member_options.getNumber();
                },
                getNumber: function () {
                    $('#contact_info').on('click', function (e) {
                        e.preventDefault();

                        $(this).parent().hide(); // Hide the click button

                        var member_info = $('#member_number');

                        if ($(member_info).hasClass('hidden')) {
                            $(member_info).removeClass('hidden');
                        }
                    });
                }
            };
            member_options.init();
        });
    </script>
@stop