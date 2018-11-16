@extends('layouts.master')

@section('title') Search Not Found - Compare Prices - Smart Shopping in {{ $country_name }} @stop

@section('meta')
    <meta name="keywords" content="PriceDrummer, {{ $country_name }},  price compare, price comparison, deals, product reviews, lowest prices, online shopping, forum, e-commerce, electronics"/>
<meta name="description"
      content="Compare and find best prices for everything in {{ $country_name }}. Save money on mobile phones, computers, cameras, fashion, TVs, laptops, furniture, washing machine. Smart Shopping"/>
<meta name="content-language" content=en/>
<meta property="og:description" content="Compare and find best prices for everything in {{ $country_name }}."/>
<meta property="og:title" content="http://pricedrummer.com"/>
<meta property="og:url" content="http://pricedrummer.com"/>
@stop

@section('content') 
    <section class="container">
    <section class="row">
        <div class="col-xs-12 col-sm-6 col-lg-12 col-md-12" id="no-search">
            <h4>0 results for search "<span style="color: #FF5500;">{{urldecode($search_param)}}</span>".</h4>
        </div>

        <div class="col-md-6 col-xs-12 col-sm-6 col-lg-6 col-md-offset-3 col-lg-offset-3" id="search-tips">
            <h4>Search Tips</h4>
            <ul>
                <li>Check your spelling for typing errors</li>
                <li>Try using general search terms (i.e "LG TV" instead of "LG 42LF551V 42 Inches")</li>
                <li>Use a different keyword or a more common term (i.e "Mobile phones", "Cars", "Laptops", "TVs")
                </li>
            </ul>
        </div>
    </section>

    <div>
        <div class="panel-widget-wrapper clearfix" style="margin-bottom: 15px;">
            <div class="panel-widget">
                <div class="panel-widget-heading">
                    <h2 class="panel-title">Please Checkout These Popular Categories...</h2>
                </div>
                <div class="panel-widget-body">
                     @foreach($home_quick_categories as $key => $category)
                        <div class="col-md-4 col-lg-4 col-sm-6 no-padding panel-widget-thumbs">
                            <h5>{{$category->name}}</h5>
                            <div class="col-md-4 col-sm-3 no-padding"><img alt="{{$category->name}}'s image"
                                                                           src="/img/60x60/{{$category->image}}"
                                                                           title="{{$category->name}}">
                            </div>
                            <div class="col-md-8 col-sm-9 no-padding">
                                <ul class="panel-widget-categories">
                                    @foreach($category->sub_categories as $key => $sub_category)
                                        <li>
                                            <a href="{{$sub_category->url}}">
                                                {{$sub_category->shortname}}{{ $loop->last ? "" : "," }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</section>
@stop

@section('scripts') @stop