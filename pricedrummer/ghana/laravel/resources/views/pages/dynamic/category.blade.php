@extends('layouts.master')

@section('title') Compare {{ $category->name }} Prices - PriceDrummer {{ $country_name }} @stop

@section('meta')
    <meta name="keywords"
          content="{{ $category->name }}, Compare {{ $category->name }} prices, Cheap {{ $category->name }} products online, reviews on {{ $category->name }} products, expert {{ $category->name }} reviews,  discount {{ $category->name }}, cheapest {{ $category->name }} products online, PriceDrummer {{ $country_name }}"/>
    <meta name="description"
          content="{{ $category->name }}. Compare {{ $country_name }} prices for {{ $category->name }} brands, read product reviews and use our easy price comparison to help you find the best value online at PriceDrummer"/>
    <meta property="og:title" content="{{ $category->name }} – Best deals on PriceDrummer {{ $country_name }}"/>
    <meta property="og:description"
          content="Find the cheapest prices on {{ $category->name }} on PriceDrummer {{ $country_name }}"/>
@stop

@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-12 col-sm-12 hidden-xs col-lg-12" style="margin-top: -10px;">
                <div class="breadcrumb">
                    <div class="bread-crumb">
                        <ul>
                            <li class="bc-home"><a href="{{ url('/') }}">PriceDrummer</a></li>
                            <li class="bc-home breadcrumb-last">{{$category->name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- end row div -->

        <div class="row">
            <div class="col-md-10 col-xs-12 col-lg-10" style="margin-top: -10px;">
                <div class="row product_page">
                    <div style="">
						<?php $classNum = 1; ?>
                        @foreach($categories as $key => $category_l2)
                            <div class="<?php
							echo "class" . $classNum;
							$classNum ++;
							if ( $classNum > 3 ) {
								$classNum = 1;
							}
							?>">
                                <p class="head_proname">{{$category_l2->name}}</p>
                                <div class="thumbnail single-list-product test-category" style="width: 100%;">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="image_wrapper">
                                                <img src="/img/cat_images/{{ ReformatID( $category_l2->name ) }}.png"
                                                     alt="asqwsada" title="">
                                            </div>

                                        </div>
                                        <div style="margin-top: 10px;_max-height: 105px;overflow: hidden;transition: all 2s ease;"
                                             id="category_lev_3_list" class="row">
                                            <div class="list_info">
                                                <ul>
                                                    @foreach($category_l2->lev3s as $key => $category_l3)
                                                        <li>
                                                            <a style="font-size: 12px;"
                                                               class="<?php if ( count( $category_l3->lev4s ) > 0 ) {
																   echo 'disabled';
															   } else {
																   echo '';
															   } ?>"
															   <?php
															   if ( count( $category_l3->lev4s ) > 0 ) {
																   echo '';
															   } else {
																   echo 'href="/filter/' . $category_l3->category_id . '/' . spacelessUrl( lowercase( $category_l3->name ) ) . '"';
															   } ?>
                                                               title="">
                                                                {{$category_l3->name}}
                                                            </a>
                                                            @foreach($category_l3->lev4s as $key => $category_l4)
                                                                <div class="level-4sub"
                                                                     style="margin-left: 17px; font-size: 11px;">
                                                                    <a style="font-size: 12px;"
                                                                       href="/filter/{{$category_l4->category_id}}/{{spacelessUrl(lowercase($category_l4->name))}}"
                                                                       title="">{{$category_l4->name}}</a>
                                                                </div>
                                                            @endforeach
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <button class="show_all">Show all...</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>


                    <div class="row" style="margin-top: -10px;">
                        <div class="col-md-12 col-lg-12">
                            <div class="col-md-4 col-sm-6 col-xs-12" id="MyClass1">
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12" id="MyClass2">
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12" id="MyClass3">
                            </div>
                        </div>
                    </div>


                </div>
            </div> <!-- end col-md-10 div -->

            <div class="col-md-2" style="margin-left: -5px; margin-top: -10px;">
                <!--<div class="handle_abs">-->
                <!--<div class="category_area" style="height: 736px; padding: 5px;">-->
                <!--<p>Content of advert goes here.</p>-->
                <!--</div>-->
                <!--</div> -->
            </div><!-- end col-md-2 div -->
        </div> <!-- end row div -->
    </div>

	<?php
	echo "<script>
            $('#MyClass1').html($('.class1'));
            $('#MyClass2').html($('.class2'));
            $('#MyClass3').html($('.class3'));
         </script>";
	?>
@stop