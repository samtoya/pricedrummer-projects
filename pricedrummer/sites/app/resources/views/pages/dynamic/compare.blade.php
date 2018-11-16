@extends('layouts.master')

@section('title') {{ $compare_product->name }} - Compare {{ $compare_product->name }} Best Prices - PriceDrummer {{ $country_name }} @stop

@section('meta')
    <meta name="keywords"
          content="Buy a {{ $compare_product->name }} online, TVs, Compare {{ $compare_product->name }} prices, cheap Samsung TVs - PriceDrummer {{ $country_name }}"/>
    <meta name="description"
          content="Compare {{ $compare_product->name }} prices among hundreds of merchants, read reviews for {{ $compare_product->name }}. Use PriceDrummer's easy TVs price comparison tools to help you find the best value {{ $compare_product->name }} TVs online."/>
    <meta property="og:title" content="{{ $compare_product->name }} – Best deals on PriceRunner UK"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:description"
          content="Find the cheapest prices on this {{ $compare_product->name }} on PriceDrummer {{ $country_name }}"/>
@stop

@section('content')
    <!--start category slider area-->
    <div class="container" style="margin-top: 15px;">
        <!-- Breadcrumb begins -->
        <div class="row">
            <div class="no-padding col-md-12 col-sm-12 hidden-xs col-lg-12" style="margin-top: -7px;">
                <div class="breadcrumb">
                    <div class="bread-crumb">
                        <ul>
                            <li class="bc-home"><a href="{{url('/')}}">PriceDrummer</a></li>
                            @foreach( $breadcrumbs as $breadcrumb )
                                @if($loop->first)
                                    <li class="bc-home"><a href="/category/{{ $breadcrumb->category_id }}/{{spacelessUrl(lowercase($breadcrumb->name)) }}">{{ $breadcrumb->name }}</a></li>
                                @elseif($loop->last)
                                    <li class="bc-home"><a href="/filter/{{$breadcrumb->category_id}}/{{spacelessUrl(lowercase($breadcrumb->name)) }}">{{ $breadcrumb->name }}</a></li>
                                @else
                                    <li class="bc-home breadcrumb-not-last">{{ $breadcrumb->name }}</li>
                                @endif
                            @endforeach
                            <li class="bc-home breadcrumb-last">{{ $compare_product->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- end row div -->
        <!-- Breadcrumb ends here -->
        <div class="row" style="margin-top: 35px;">
            <!--slider coloum-->
            <div class="no-padding col-md-9 col-xs-12">
                <section>
                    <div class="row" style="margin-top: -16px;">
                        <div class="col-md-12">
                            <div class="shop-area">
                                <div class="single-list-product1">
                                    <div class="col-md-4 col-sm-4 col-sm-4 col-xs-4">
                                        <a class="img-icon hidden-xs" data-toggle="modal" data-target="#product_image">
                                            <i class="fa fa-picture-o" aria-hidden="true"></i>
                                            {{ $total_images }}
                                        </a>

                                            <img class="visible-xs" style="max-height: 250px; display: block; padding: 0 0 20px;margin-left: 0;"
                                                 src="//pricedrummer.com/images/static/product_images/medium/{{$compare_product->image}}.png"
                                                 alt="{{ $compare_product->name }}'s image"
                                                 title="{{ $compare_product->name }}">

                                        <a data-target="#product_image" data-toggle="modal" class="hidden-xs">
                                            {{--<img style="height: 210px; display: block; padding: 0 0 20px;margin-left: 0;" src="//placehold.it/71x52" alt="" title="">--}}
                                            <img style="max-height: 250px; display: block; padding: 0 0 20px;margin-left: 0;"
                                                 src="//pricedrummer.com/images/static/product_images/medium/{{$compare_product->image}}.png"
                                                 alt="{{ $compare_product->name }}'s image"
                                                 title="{{ $compare_product->name }}">
                                        </a>
                                    </div>

                                    <div class="col-sm-8 col-md-8 col-sm-8 col-xs-8">
                                        <div class="prod-list-detail">
                                            <div class="prod-info" style="text-align:left;">
                                                <h1 class="ret_content">
                                                    {{$compare_product->name}}
                                                </h1>
                                                <div class="price-box">
                                                    <div class="price">
                                                        <span class="range">Lowest: Gh&cent;{{sprintf("%.2f", $compare_product->min_price)}}</span>
                                                    </div>

                                                </div>
                                                <div class="ret_lair">
                                                    <span>
                                                        <a href="">{{ $compare_product->prices_count }} {{ str_plural('price', $compare_product->prices_count) }}</a>
                                                    </span>
                                                </div>

                                                <div class="rating">
                                                    @for($j=0; $j <=4; $j++)
                                                        <i class="fa fa-star-o"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END SECOND BOX-->

                        <!--THIRD BOX-->

                        <!--END THIRD BOX-->

                        <!--FOUTH BOX-->

                        <!--END FOUTH BOX-->
                    </div>
                </section>


                <div class="ad-area visible-xs" style="margin: 10px auto -20px;width: 95%;">
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

                <!--strat category list-->
                <div class="row" style="margin-top: 12px;">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="compare_box">
                            <ul class="nav nav-tabs nav-pills" style="margin-left: 0;">
                                <li class="active"><a aria-expanded="true" data-toggle="tab"
                                                      target="_self" href="#home" class="style_aheader">Compare
                                        Price</a></li>
                                <li class=""><a aria-expanded="false" data-toggle="tab"
                                                target="_self" href="#menu1" class="style_aheader">Product
                                        Information</a></li>
                            </ul>

                            <div class="tab-content" style="margin-left: 0; padding: 15px;">
                                <div id="home" class="tab-pane fade active in">
                                    <div class="row">
                                        <table class="table table-responsive" style="width: 97%;margin-bottom:0;">
                                            <thead>
                                            <tr class="table_header">
                                                <th style="text-align: center;width: 20%;">Retailer</th>
                                                <th style="text-align: center;"
                                                    class="visible-sm visible-md visible-lg hidden-xs">Rating
                                                </th>
                                                <th style="text-align: center;"
                                                    class="cell4 visible-sm visible-md visible-lg hidden-xs">Product
                                                </th>
                                                <th style="text-align: center;" class="cell4">Price</th>
                                                <th style="text-align: center;width: 20px;" class="cell5"></th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach( $products_retailers as $retailer )

                                                <tr>
                                                    <td style="text-align: center; padding: 10px 5px;">
                                                        @if( $retailer->is_offline == 0 )
                                                            <img src="//pricedrummer.com/images/static/merchants/{{$url_country_name}}/{{ $retailer->merchant_id }}.jpg" style="max-width: 70%;">
                                                        @elseif( $retailer->is_offline == 1 )
                                                            <img src="//pricedrummer.com/images/static/retailers/{{$url_country_name}}/{{ $retailer->retailer_id }}.jpg" style="max-width: 70%;">
                                                        @endif

                                                        <div class="rating visible-xs">
                                                            @for($i=0; $i <= 4; $i++)
                                                                <i class="fa fa-star-o"></i>
                                                            @endfor
                                                        </div>
                                                    </td>

                                                    <td style="text-align: center;vertical-align: middle;"
                                                        class="hidden-xs">
                                                        <div>
                                                            <div class="rating">
                                                                @for($i=0; $i <= 4; $i++)
                                                                    <i class="fa fa-star-o"></i>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td style="text-align: center; vertical-align: middle;"
                                                        class="hidden-xs">
                                                        @if( $retailer->is_offline == 0 )
                                                            <h5 class="descrip" title="">{{ $retailer->product_name }}</h5>
                                                        @elseif( $retailer->is_offline == 1 )
                                                            <h5 class="descrip" title="">{{ $retailer->name }}</h5>
                                                        @endif
                                                    </td>

                                                    <td class="price_table"
                                                        style="text-align: center;vertical-align: middle;">
                                                        <div>
                                                            <strong class="pri_ce">Gh&cent; {{ sprintf("%.2f", $retailer->price) }}</strong>
                                                        </div>
                                                    </td>


                                                    @if( $retailer->is_offline == 0 )
                                                        <td style="text-align:left; vertical-align: middle;padding-right: 15px;" class="change_btn_co">
                                                            <a target="_blank" href="/redirect/{{ $retailer->product_ID }}?curl={{urlencode($compare_product->compare_url)}}" class="btn btn-warning">Go to Store</a>
                                                        </td>
                                                    @elseif( $retailer->is_offline == 1 )
                                                        <td style="text-align:left; vertical-align: middle;padding-right: 15px;" class="change_btn_co">
                                                            <a  href="{{ $retailer->url }}" class="btn btn-warning">Contact Seller</a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <p></p>
                                </div>

                                <div id="menu1" class="tab-pane fade">
                                    <br>
                                    <h3 style="font-size: 16px;">Product Information</h3>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            @foreach( $product->sc_detail as $key => $spec )
                                                <div>
                                                    <table class="table">
                                                        <tr style="border: none;">
                                                            @if( $key == 0 )
                                                                <td style="border: none;">
                                                                    <h4 style="margin: 20px 0 2px;">{{ $spec->category_section }}</h4>
                                                                </td>
                                                            @elseif($key > 0)
                                                                <td style="border: none;">
                                                                    @if( $product->sc_detail[$key-1]->category_section != $spec->category_section )
                                                                        <h4 style="margin: 20px 0 2px;">{{ $spec->category_section }}</h4>
                                                                    @endif
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            @if( $spec->detail_name == "Video Link")
                                                                @continue
                                                            @else
                                                                <td style="width: 50%; padding-top: 10px; padding-bottom: 10px;">
                                                                    {{ $spec->detail_name }}
                                                                </td>
                                                                <td style="border-left: 1px solid #CCCCCC; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">
                                                                    {{ ReformatHTML($spec->details_value) }}
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    </table>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <p></p>
                                </div>

                                <div id="menu2" class="tab-pane fade">
                                    <br>
                                    <h3>Product Reviews</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--strat category list-->
            </div>

            <div class="col-md-3 hidden-xs" style="margin-top: -16px;">
                <!-- Advertisement goes here -->
                <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Medium Rectangle - Mobile & Desktop -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:300px;height:250px"
                     data-ad-client="ca-pub-2224646482907163"
                     data-ad-slot="1452345733"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
    </div>

    {{-- Product Image Modal --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="product_image">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: 22px 30px;">
                    <span aria-hidden="true">&times;</span>
                </button>

                <ul class="nav nav-tabs nav-pills" style="margin-left: 0; border-top: medium none;">
                    <li class="active" style="z-index: 5000;">
                        <a style="padding: 23px 32px; z-index: 1000;" aria-expanded="true"
                           data-toggle="tab" target="_self" href="#image" class="style_aheader">Images
                        </a>
                    </li>
                    <li>
                        <a style="padding: 23px 32px" aria-expanded="false"
                           data-toggle="tab" target="_self" href="#video"
                           class="style_aheader">Video
                        </a>
                    </li>
                </ul>

                <div class="modal-body" style="padding: 0; z-index: 2000;">
                    <div class="tab-content" style="margin-left: 0; padding: 15px; height: 400px;">
                        <div id="image" class="tab-pane fade active in">
                            <div class="row" style="height: 400px;">
                                <div style="width:70%; height:auto;">
                                    <section class="slider">
                                        <div id="slider" class="flexslider" style="margin-bottom: 10px;">
                                            <ul class="slides">

                                                @foreach( $product_images as $product_image )
                                                    <li>
                                                        <img class="SilDImg"
                                                             src="http://www.pricedrummer.com/images/static/product_images/large/{{ $product_image->image_id }}.png" alt="""/>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                        <div id="carousel" class="flexslider"
                                             style="
									width: 390px !important;
									transform: rotate(90deg) !important;
									-ms-transform: rotate(90deg) !important;
									-webkit-transform: rotate(90deg) !important;
									position: absolute !important;
									top: 156px !important;
									left: -113px !important;
									margin: auto !important;
									z-index: 1;">
                                            <ul class="slides">
                                                @foreach( $product_images as $product_image )
                                                    <li>
                                                        <img class="galImg"
                                                             src="http://www.pricedrummer.com/images/static/product_images/thumbs/{{$product_image->image_id}}.png" alt=""/>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </section>

                                </div>
                            </div>
                        </div>

                        <div id="video" class="tab-pane fade">
                            <br>
                            <h3>Product Information</h3>
                            <div class="row" style="padding-left:15px">
                                <div style="text-align: center;">
                                    <span >{!! $product_video_link !!}</span>
                                </div>
                            </div>
                            <p></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End product image modal--}}
@stop

@section('scripts')
    <script>

        //        $( "#product_image" ).on('show', function(){
        //            alert("Show!");
        //        });
        //        $( "#product_image" ).on('shown', function(){
        //            alert("Shown!");
        //        });



        $(document).ready(function () {
            $('#product_image').on('shown.bs.modal', function () {
                $('#carousel').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    itemWidth: 100,
                    itemMargin: 5,
                    asNavFor: '#slider'
                });
                $('#slider').flexslider({
                    animation: "slide",
                    controlNav: true,
                    animationLoop: false,
                    slideshow: false,
                    sync: "#carousel",
                    start: function(slider) {
                        $('body').removeClass('loading');
                    }
                });
            })



        });

    </script>
@stop