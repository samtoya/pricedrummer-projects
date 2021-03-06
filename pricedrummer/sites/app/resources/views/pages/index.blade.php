@extends('layouts.master')

@section('title') Compare Prices - Smart Shopping in {{ $country_name }} @stop

@section('meta')
    <meta name="keywords"
          content="PriceDrummer, {{ $country_name }},  price compare, price comparison, deals, product reviews, lowest prices, online shopping, forum, e-commerce, electronics"/>
    <meta name="description"
          content="Compare and find best prices for everything in {{ $country_name }}. Save money on mobile phones, computers, cameras, fashion, TVs, laptops, furniture, washing machine. Smart Shopping"/>
    <meta name="content-language" content=en/>
    <meta property="og:description" content="Compare and find best prices for everything in {{ $country_name }}."/>
    <meta property="og:title" content="http://pricedrummer.com"/>
    <meta property="og:url" content="http://pricedrummer.com"/>
@stop

@section('content')
    <div class="handle_home_section">
        <section class="container">
            <div class="row">
                {{--Sidebar--}}
                <div class="col-md-3 hidden-sm hidden-xs nopadding">
                    <div class="home-category-nav">
                        <div class="category_area">
                            <div class="cat_header">
                                <p class="cat-heading">Compare Prices</p>
                            </div>
                            <div class="category_list">
                                <div>
                                    <div class="cat_header">
                                        <ul>
                                            @foreach ($categories as $key => $category )
                                                @if($category->category_ID != '537')
                                                    <li>
                                                        <h3>
                                                            <a href="/category/{{ $category->category_ID }}/{{spacelessUrl(lowercase( $category->name ))}}">
                                                                <img width="36" height="36" src="{{ asset('/img/category_icons/' . ReformatID($category->name) . '.png') }}"
                                                                     alt="">{{ $category->name }}
                                                            </a>
                                                        </h3>
                                                        <ul>
                                                            @foreach ($category->category_children as $key => $category_lev3 )
                                                                <li>
                                                                    <a class="nav-action"
                                                                       href="/filter/{{ $category_lev3->category_ID }}/{{spacelessUrl(lowercase( $category_lev3->name ))}}">{{ $category_lev3->name }}, </a>
                                                                </li>
                                                            @endforeach
                                                            <li><a class="nav-action"
                                                                   href="/category/{{ $category->category_ID }}/{{spacelessUrl(lowercase( $category->name ))}}">View
                                                                    More</a></li>
                                                        </ul>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="see-all_category"><a href="{{ url('/all_categories') }}">see all <i
                                                class="fa fa-angle-right" aria-hidden="true"></i><i
                                                class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Main content--}}
                <div class="col-lg-7 col-md-7 hidden-xs" style="margin-left: 0;">
                    <div class="handle_slider" style="margin-bottom: 15px;">
                        <div id="home_slides_control">

                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    @foreach($slides as $key => $slide)
                                        <li data-target="#myCarousel" data-slide-to="{{$key}}" <?php if ( $key == 0 ) {
											echo "class='active'";
										}?> ></li>
                                    @endforeach
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">

                                    @foreach($slides as $key => $slide)
                                        <div class="item <?php if ( $key == 0 ) {
											echo 'active';
										}?> ">
                                            <a href="{{$slide->url}}"><img src="{{$slide->image}}"
                                                                           style="margin:auto;width: 750px;height: 326px;"></a>
                                        </div>
                                    @endforeach

                                </div>

                                <!-- Left and right controls -->
                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="panel-widget-wrapper clearfix" style="margin-bottom: 15px;">
                        <div class="panel-widget">
                            <div class="panel-widget-heading">
                                <h2 class="panel-title">Compare prices before you buy</h2></div>
                            <div class="panel-widget-body">
                                <div class="col-md-12 no-padding">
                                    @foreach($home_quick_categories as $key => $category)
                                        <div class="col-md-4 col-lg-4 col-sm-6 no-padding panel-widget-thumbs">
                                            <h5>{{$category->name}}</h5>
                                            <div class="col-md-4 col-sm-3 no-padding"><img
                                                        alt="{{$category->name}}'s image"
                                                        src="{{ asset('img/60x60/' . $category->image) }}" width="60" height="60"
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
                    <div class="col-md-5 col-sm-5 col-xs-12 no-padding" style="padding-right: 0;">
                        <div class="blog-social-area">
                            <div class="panel panel-default" style="margin-left: 0;">
                                <div class="panel-body" style="padding:0;">
                                    <div class="blog_area">
                                        <a href="http://blog.pricedrummer.com/" target="_blank">
                                            <h3>
                                                <button class="btn btn-warning btn-lg">Blog</button>
                                            </h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-7 hidden-xs" style="padding-right: 0px;">
                        <div class="social-media-area">
                            <div class="panel panel-default">
                                <div class="panel-body" style="padding:0;">
                                    <div class="fb-page" data-href="https://www.facebook.com/PriceDrummer{{$country_code}}"
                                         data-tabs="timeline" data-width="358" data-height="215"
                                         data-small-header="false" data-adapt-container-width="true"
                                         data-hide-cover="false" data-show-facepile="true">
                                        <blockquote cite="https://www.facebook.com/PriceDrummer{{$country_code}}"
                                                    class="fb-xfbml-parse-ignore"><a
                                                    href="https://www.facebook.com/PriceDrummer{{$country_code}}">PriceDrummer.com -
                                                compare prices in {{$country_name}}</a></blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Advertizement--}}
                <div class="col-md-2 hidden-xs nopadding">
                    <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- Wide Skyscraper 160 x 600 -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:160px;height:600px"
                         data-ad-client="ca-pub-2224646482907163"
                         data-ad-slot="8696410934"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>

            <div class="handle_home_category_section">
                <div class="row">
                    <div class="col-md-12 col-sm-12 hidden-xs no-padding">
                        <div class="top-category-area">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Top Categories</h3></div>
                                <div class="panel-body" style="padding: 0 13px;">
                                    <div class="row">
                                        @foreach($top_categories as $key => $category)
                                            <div class="col-md-3 col-sm-3 col-xs-6"
                                                 style="padding: 2px; overflow:hidden;">
                                                <div onmouseover="showSubCat(this);" onmouseleave="hideSubCat(this)"
                                                     class="cat_paddin top_Cats"
                                                     style='background-image: url("img/{{$category->image}}");'>
                                                    <a href="">
                                                        <h3>{{$category->name}}</h3></a>
                                                    <div style="" class="CategorySub hide_sub-cat">
                                                        <h3>{{$category->name}}</h3>
                                                        <ul class="topcats">
                                                            @foreach($category->children as $key => $category_sub)
                                                                <li><a
                                                                            href="/filter/{{$category_sub->id}}/{{spacelessUrl(lowercase( $category_sub->name ))}}"
                                                                            class="top_categories_catzero_link">{{$category_sub->shortname}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="hidden-lg hidden-sm hidden-md col-xs-12">

                                <div class="ad-area" style="margin-top: -25px; margin-bottom: 25px; margin-left: -8px;">
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

                                <div class="popular category_area">
                                    <div class="category-widget-wrapper">
                                        <div class="category-widget">
                                            <div class="category-widget-heading">
                                                <h2 class="category-title">Compare Prices</h2></div>
                                            <div class="category-widget-content">
                                                <ul>
                                                    @foreach( $categories as $category )
                                                        @if($category->category_ID != '537')
                                                        <span>
                                                            <a href="/category/{{ $category->category_ID }}/{{spacelessUrl(lowercase( $category->name ))}}">
                                                                <li>
                                                                    <img width="36" height="36" style="margin-right: 10px;"
                                                                         src="{{ asset('/img/category_icons/' . ReformatID($category->name) . '.png') }}">{{ $category->name }}
                                                                    <span
                                                                            style="display: inline-block; line-height: 0; margin-top: 10px;"
                                                                            class="fa fa-angle-right pull-right"
                                                                            aria-hidden="true">
                                                                    </span>
                                                                </li>
                                                </a>
                                                </span>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ad-area" style="margin-top: 10px; margin-left: 5px;">
                                    <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                    <!-- Mobile Banner 320 x 50 -->
                                    <ins class="adsbygoogle"
                                         style="display:inline-block;width:320px;height:50px"
                                         data-ad-client="ca-pub-2224646482907163"
                                         data-ad-slot="8836011731"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2 col-xs-12"></div>
                <div class="hidden-lg hidden-sm hidden-md col-xs-12"></div>
                <div class="col-md-2 col-lg-2 col-xs-12"></div>
                <div class="hidden-md hidden-sm hidden-lg col-xs-12"></div>
                <div class="hidden-md hidden-lg hidden-sm col-xs-12"></div>
            </div>
        </section>
    </div>
    <script>

    </script>
@stop