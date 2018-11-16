@extends('layouts.master')

@section('title') Compare {{ $category->name }} Prices - PriceDrummer {{ $country_name }} @stop

@section('meta')
    @if ( $category->name == "Electronics & Computers")
        <meta name="description" content="Compare prices and save money on the best deals for phones, TVs, laptops, tablets, PCs, cameras, game consoles, audio systems, printers, and more in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals, Electronics, computers, monitors, mobile phones, TVs, laptops, tablets, cameras, game consoles, home theater, audio speakers, printers, projectors, electronic accessories"/>

    @elseif ( $category->name == "Camera" )
        <meta name="description" content="Compare prices and save money on the best deals on Cameras from Sony, Nikon, Leica, Samsung, Canon, Olympus, Fuji, Kodak, and more in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals,  Digital Cameras, Sony, Nikon, Leica, Samsung, Canon, Olympus, Fuji, Kodak"/>

    @elseif ( $category->name == "Camcoders" )
        <meta name="description" content="Compare prices and save money on the best deals on Camcorders, action cameras from Panasonic, Canon, Sony, JVC, GoPro, Olympus, Garmin, and more in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals,  Camcorders, Action Cameras,  Panasonic, Canon, Sony, JVC, GoPro, Olympus, Garmin, Tomtom"/>

    @elseif ( $category->name == "Projectors" )
        <meta name="description" content="Compare prices and save money on the best deals on Projectors from Epson, BenQ, Sony, Nec, Optoma, ViewSonic, Canon, InFocus, LG, Dell, and more in {{ $country_name }}.">

    @elseif ( $category->name == "TVs" )
        <meta name="description" content="Compare prices and save money on the best deals on TVs from Samsung, LG, Panasonic, Sony, Nasco, Bruhm, Grundig, TCL, Sharp, Skyworth, and more in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals, TVs, Samsung, LG, Panasonic, Sony, Nasco, Bruhm, Grundig, TCL, Sharp, Skyworth"/>

    @elseif ( $category->name == "Home Theater Systems" )
        <meta name="description" content="Compare prices and save money on the best deals on home theater systems, sound bars, blu-ray players, Hi-Fi systems, amplifiers, and more in {{ $country_name }}.">
    <meta name="keywords"
          content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals, home theater systems, sound bars, blu-ray players, Hi-Fi systems, amplifiers, receivers, dvd players"/>

    @elseif ( $category->name == "Mobile Phones" )
        <meta name="description" content="Compare prices and save money on the best deals for mobile phones like Samsung, Apple, Infinix, Huawei, Tecno, Itel, Hotwav, Lumia, HTC, LG, and more in {{ $country_name }}.">
    <meta name="keywords"
          content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals, Mobile phones, Samsung, Apple, Infinix, Huawei, Tecno, Itel, Hotwav, Lumia, HTC, LG"/>

    @elseif ( $category->name == "Game Consoles" )
        <meta name="description" content="Compare prices and save money on the best deals on game consoles like Xbox One, Playstation 4, Nintendo Shield, Nvidia Shield, and more in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals, game consoles Xbox One, Xbox 360, Playstation 4, Playstation 3, Playstation Vita, Nintendo Shield, Nintendo 3DS, Nvidia Shield"/>

    @elseif ( $category->name == "Laptops" )
        <meta name="description" content="Compare prices and save money on the best deals for traditional laptops, 2-in-1 laptops, mobile workstations, chromebooks, gaming notebooks, in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals, traditional laptops, 2-in-1 laptops, mobile workstations, chromebooks, gaming notebooks"/>

    @elseif ( $category->name == "Tablets" )
        <meta name="description" content="Compare prices and save money on the best deals on Android tablets, iPads, 2-in-1 tablets, Microsoft Surface tablets, Amazon Kindle, and more in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals, tablet computer, Android tablets, iPads, 2-in-1 tablets, Microsoft Surface tablets, Amazon Kindle"/>

    @elseif ( $category->name == "Printers" )
        <meta name="description" content="Compare prices and save money on the best deals on ink and laser printers, all-in-ones, from HP, Canon, Epson, Dell, Brother, Samsung, and more in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals, ink and laser printers, all-in-ones, HP, Canon, Epson, Dell, Brother, Samsung"/>

    @elseif ( $category->name == "Scanners" )
        <meta name="description" content="Compare prices and save money on the best deals on flatbed and sheet feeder scanners from HP, Canon, Kodak, Epson, Brother, Xerox, and more in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals,  flatbed Scanners, sheet feeder scanners, HP, Canon, Kodak, Epson, Brother, Xerox, Fujitsu"/>

    @elseif ( $category->name == "Desktops" )
        <meta name="description" content="Compare prices and save money on the best deals on desktops, all-in-ones, mini computers, servers from HP, Dell, Asus, Apple, IBM, and more in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals, desktops, all-in-ones, mini computers, servers, HP, Dell, Asus, Apple, IBM"/>

    @elseif ( $category->name == "Home & Garden" )
        <meta name="description" content="Compare prices and save money on the best deals for fridges, kitchen stoves, air conditioners, washing machines, furniture, generators, and more in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals, home appliances, home office Furniture, bedding and bath, generators, gardening tools, kitchen and bathroom fixtures, lighting"/>

    @elseif ( $category->name == "Toys, Children & Family" )
        <meta name="description" content="Compare prices and save money on the best deals for toys, strollers, kids furniture, child safety seats, feeding bottles, baby hygiene, and more in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals, toys, kids furniture, child safety seats, feeding chairs, feeding bottles, baby hygiene"/>

    @elseif ( $category->name == "Clothes, Shoes & Jewellery" )
        <meta name="description" content="Compare prices and save money on the best deals on clothing for men, women, kids, and babies, shoes, jewelery, and other clothing accessories in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals, men clothing, women clothing, clothing for babies and kids, shoes. Jewelry, cloth accessories"/>

    @elseif ( $category->name == "Health & Beauty" )
        <meta name="description" content="Compare prices and save money on the best deals for perfumes, make-up, skincare, hair and eye products, health monitors, first-aid, and more in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, shopping in {{ $country_name }}, compare prices, best deals, health and beauty, Nutrition products, First Aid, Personal Care, Perfume, Hair Care, Skincare, Eye and Ear Care, Health Monitors, Make-up Health and Beauty Accessories"/>

    @elseif ( $category->name == "Autos & Accessories" )
        <meta name="description" content="Compare prices and save money on the best deals for new or used cars, motorbikes, pickups, buses, trucks, auto parts, car accessories, and more in {{ $country_name }}.">
        <meta name="keywords"
              content="Smart shopping online, cars in {{ $country_name }}, compare prices, best deals, new and used cars, motorbikes, pickups, buses, trucks, auto parts, car accessories"/>

    @else
        <meta name="description"
        content="{{ $category->name }}. Compare {{ $country_name }} prices for {{ $category->name }} brands, read product reviews and use our easy price comparison to help you find the best value online at PriceDrummer in {{ $country_name }}"/>
        <meta property="og:description"
        content="Find the cheapest prices on {{ $category->name }} on PriceDrummer {{ $country_name }}"/>
        <meta name="keywords"
              content="{{ $category->name }}, Compare {{ $category->name }} prices, Cheap {{ $category->name }} products online, reviews on {{ $category->name }} products, expert {{ $category->name }} reviews,  discount {{ $category->name }}, cheapest {{ $category->name }} products online, PriceDrummer {{ $country_name }}"/>
    @endif

    <meta property="og:title" content="{{ $category->name }} – Best deals on PriceDrummer {{ $country_name }}"/>
    <meta name="og:description" content="Compare prices and save money on the best deals for {{ $category->name }}, and more on PriceDrummer in {{ $country_name }}.">
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
                            <div class="ad-area visible-xs" style="margin: -20px auto 5px;">
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

            <div class="col-md-2 hidden-xs" style="margin-left: -5px; margin-top: -10px;">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Wide Skyscraper 160 x 600 -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:160px;height:600px"
                     data-ad-client="ca-pub-2224646482907163"
                     data-ad-slot="8696410934"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
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