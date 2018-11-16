@extends('layouts.master')

@section('title') {{$category_name}} prices - Compare {{$category_name}} deals when buying a {{$category_name}} @stop

@section('meta')
    <meta name="keywords"
          content="Compare prices on {{$category_name}}, Cheap {{$category_name}} online, reviews on {{$category_name}}, {{$category_name}}, discount {{$category_name}}, Cheapest {{$category_name}}, PriceDrummer {{ $country_name }}"/>
    <meta name="description" content="Compare prices on {{$category_name}} on PriceDrummer to help you find the best deal online"/>
    <meta property="og:title" content="{{$category_name}} - Best deals on PriceDrummer {{ $country_name }}"/>
    <meta property="og:description" content="Compare and find best prices for everything in {{ $country_name }}."/>
@stop

@section('content')

    <div class="container" style="margin-top: 15px;">
        <!-- Breadcrumb begins -->


        <div class="row">


            <div class="no-padding col-md-12 col-sm-12 hidden-xs col-lg-12" style="margin-top: -10px;">
                <div class="breadcrumb">
                    <div class="bread-crumb">
                        <ul>
                            <li class="bc-home"><a href="{{url('/')}}">PriceDrummer</a></li>
                            @foreach( $breadcrumbs as $breadcrumb )
                                @if($loop->first)
                                    <li class="bc-home">
                                        <a href="/category/{{ $breadcrumb->category_id }}/{{spacelessUrl(lowercase($breadcrumb->name)) }}">{{ $breadcrumb->name }}</a>
                                    </li>
                                @elseif($loop->last)
                                    <li class="bc-home breadcrumb-last">{{ $breadcrumb->name }}</li>
                                @else
                                    <li class="bc-home breadcrumb-not-last">{{ $breadcrumb->name }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- end row div -->
        <!-- Breadcrumb ends here -->
        <div class="row">

            <!-- Main Filter Sidebar (Make it off-canvas on mobile) -->
            <div id="filterBar" class="col-md-3 hidden-xs col-lg-3 col-sm-4" style="margin-left: -15px; margin-top: 13px;">

                @include('pages.dynamic.shared.filters')

            </div> <!-- end col-md-3 div -->
            <!-- Main Filter Sidebar ends here -->

            <!-- Main content (width: 65%; margin-left: -15px) -->
            <div id="contentArea" class="col-md-7 col-lg-7 no-padding col-sm-8 col-xs-12" style="margin-top: 13px;">
                <div class="spinner" id="spinner" style="display: none;"><img src='/img/loading.gif' style="margin: 10% auto auto 47%;"/></div>

                <ul class="nav nav-tabs nav-pills hidden-xs" style="margin-left: 0; margin-right: 0;">
                    <li class="active"><a aria-expanded="true" data-toggle="tab"
                                          target="_self" href="#Compare_Prods" class="pad_a">Compare Products</a></li>

                    <li class=""><a aria-expanded="false" data-toggle="tab"
                                    target="_self" href="#buyers_guide" class="pad_a">Buyers Guide</a></li>
                </ul>

                <!-- Tab content goes here-->
                <div class="tab-content" style="margin: 0 0 15px;">
                    <div id="Compare_Prods" class="tab-pane fade active in">
                        <div class="container-fluid"></div>
                    </div>

                    <div id="top_products" class="tab-pane fade">
                        <div class="container-fluid">
                            <p class="tab_cont">
                            <div class="row">
                                <div class="col-xs-6 col-md-4 col-sm-4">
                                    <div class="thumbnail">
                                        <div class="product-image">
                                            <div class="show-img">
                                                <a href=""><img src="" alt="" style="max-width: 70%;">Top Product
                                                    Name</a>
                                            </div>

                                        </div>
                                        <div class="prod-info">
                                            <h2 class="pro-name1">
                                                <a href="">Top Product Name</a>
                                            </h2>

                                            <div class="flo_at">
                                                <div class="actions">
													<span class="add-to-cart">
														<a href=""
                                                           id="top_product"><span>Top Product Price</span></a>
													</span>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="buyers_guide" class="tab-pane fade">
                        <br>
                        @foreach($buyers_guide as $guide)
                            <div class="container-fluid">
                                <p class="tab_cont">
                                    <!-- Buying Guide Content Goes here -->
                                </p>
                                <span>{!! $guide->heading !!}</span>
                                <p>
                                    @if($guide->has_image == 1)
                                    <img style="float: left; border: 10px solid beige; padding: 5px; margin: 0 8px; max-height: 120px;"
                                         src="http://www.pricedrummer.com/images/static/buying_guide_images/thumbs/{{$guide->id}}.png">
                                    @endif
                                    <span class="guide_content">{!! ReformatHTML($guide->content) !!}</span>
                                </p>
                            </div><br/>
                        @endforeach
                    </div>

                </div> <!-- end tab content div -->
                <!--Tab content ends here -->





                <div class="visible-xs navbar navbar-default navbar-offcanvas navbar-offcanvas-left"  id="js-bootstrap-offcanvas" style="display: none !important;" >

                </div>






                <!-- Shop area begins here -->
                <div class="shop-area">
                    <div class="shop-short-wrapper clearfix">

                        <div class="shop-sort clearfix">
                            <ul class="pull-left" style="font-size: 12px; padding: 10px;">
                                <li class="hidden-xs" style="margin-left: 5px; font-weight: 600;">{{$compare_products_data->total}} products
                                </li>
                            </ul>
                            <ul class="grid-list-button clearfix">
                                <span id="filter_icon">
                                <li id="m-filter-btn" class="visible-xs visible- offcanvas-toggle offcanvas-toggle-close" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas">
                                    <a  >
                                        <i class="fa fa-filter"></i>
                                    </a>
                                </li>
                                    </span>
                                <li class="@if(isset($_GET['view']) && trim($_GET['view']) =='list' )
                                                {{'active'}}
                                            @endif 
                                            ">
                                    <a id="listView" href="/list">
                                        <i class="fa fa-th-list"></i> List View
                                    </a>
                                </li>

                                <li class="@if(isset($_GET['view']) && trim($_GET['view']) =='grid' )
                                                {{'active'}}
                                            @elseif( !isset($_GET['view']) )
                                                {{'active'}}
                                            @endif 
                                            ">
                                    <a id="gridView" href="/grid">
                                        <i class="fa fa-th"></i>Grid View
                                    </a>
                                </li>

                                {{--<li class="">--}}
                                    {{--<a data-toggle="tab" target="_self" href="#list">--}}
                                        {{--<i class="fa fa-th-list"></i> List View--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li class="active">--}}
                                    {{--<a data-toggle="tab" target="_self" href="#grid">--}}
                                        {{--<i class="fa fa-th"></i>Grid View--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                <li class="hidden-xs">
                                    <select class="select_dropdown">
                                        <option value="">Sort by</option>
                                        <option value="name">A-Z</option>
                                        <option value="min_price">Price</option>
                                    </select>
                                </li>

                            </ul>
                        </div>
                    </div> <!-- end shop-short-wrapper div -->




                    <div class="tab-content" style="background: none;">
                        @if($view=='grid')
                            @include('pages.dynamic.filter_grid')
                        @elseif($view=='list')
                            @include('pages.dynamic.filter_list')
                        @else
                            @include('pages.dynamic.filter_grid')
                        @endif


                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xs-12">
                                @include('pages.dynamic.shared.filter_pagination')
                            </div>
                        </div>

                    </div> <!-- end tab content div -->

                </div> <!-- end shop area div -->
                <!--Shop area ends here -->


            </div> <!-- end col-md-7 div -->
            <!-- Main content ends here -->

            <!-- Mobile content -->
            <!-- End mobile content div -->
        </div>
    </div>
@stop

@section('scripts')

    <script>
        function showCanvas() {
            console.log('theo');
            var filter_content = $('#filterBar').html();
           $('#js-bootstrap-offcanvas').append(filter_content);

            return false;
           /* $('#offcanvas').offcanvas(
                'show'
            );*/

        }

        var filter_content = '';

        /*$( document ).ready(function() {
            var html5Slider = document.getElementById('html5');

            noUiSlider.create(html5Slider, {
                start: [ 10, 30 ],
                connect: true,
                range: {
                    'min': 0,
                    'max': 40
                }
            });

            var nodes = [
                document.getElementById('lower-value'), // 0
                document.getElementById('upper-value')  // 1
            ];

            // Display the slider value and how far the handle moved
            // from the left edge of the slider.
            html5Slider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
                nodes[handle].innerHTML = values[handle] ;
            });

            html5Slider.noUiSlider.on('end', function(values){
                console.log(values);
            });


        });*/




        $('#m-filter-btn').on('click', function(e){
            e.preventDefault();
            filter_content = $('#filterBar').html();
            $('#filterBar').empty();
            $('#filter_icon').hide();
            $('#js-bootstrap-offcanvas').append(filter_content).show();
            console.log($('#js-bootstrap-offcanvas').html());
            // your ajax request

        });

        $(document).on('hide.bs.offcanvas', function (e) {
            e.preventDefault();
            console.log(filter_content);
            console.log('closing...');
            $('#js-bootstrap-offcanvas').empty().hide();
            $('#filterBar').append(filter_content);
            $('#filter_icon').show();
        });


    //Toggle Specs Container section
        function toggleView(view)
        {
            theid = $(view).attr("id");
            list_item = $(view).parent()[0];
            console.log(list_item);

            if ( $(list.item).hasClass("active") ) {
                console.log('Has class');
            } else {
                console.log('Dont have class');
            }
        }

        function ToggleFilterSpecs(ele_id) {
            $('#' + ele_id).slideToggle(900);
            var headIc = $('#' + ele_id).siblings('.filter-heading').find('#head-icon');
            if (headIc.hasClass('fa-plus-circle')) {
                headIc.removeClass('fa-plus-circle');
                headIc.addClass('fa-minus-circle');
            } else {
                headIc.removeClass('fa-minus-circle');
                headIc.addClass('fa-plus-circle');
            }
        }

    //Price Range Slider Section
      $( function() {
          var PriceSlider = document.getElementById('slider-range');

          noUiSlider.create(PriceSlider, {
              start: [ @if(isset($_GET['min_price']) && is_numeric ( trim($_GET['min_price']) ) )
                      {{$_GET['min_price']}}
                      @else
                      {{$min_price}}
                      @endif ,
                      @if(isset($_GET['max_price']) && is_numeric ( trim($_GET['max_price']) ) )
                      {{$_GET['max_price']}}
                      @else
                      {{$max_price}}
                      @endif ],
              connect: true,
              range: {
                  'min': {{$min_price}},
                  'max': {{$max_price}}
              }
          });

          var nodes = [
              document.getElementById('p-slider-min'), // 0
              document.getElementById('p-slider-max')  // 1
          ];

          // Display the slider value and how far the handle moved
          // from the left edge of the slider.
          PriceSlider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
              nodes[handle].innerHTML = "{{$country_currency}}" + values[handle] ;
          });

          PriceSlider.noUiSlider.on('end', function(values){

              $('#spinner').show();

              var min_max = {
                  'min_price': values[ 0 ] ,
                  'max_price': values[ 1 ]
              };
              window.location.assign(change_query_string_obj(min_max))
          });


        } );








        // Generate href for the list and grid view
        $('#gridView').attr('href',change_query_string('view','grid'));
        $('#listView').attr('href',change_query_string('view','list'));



        //============= Genetal price range initializer ================
        function init_range_slider(slider_id,min_val,max_val,unit_of_measure,min_display,max_display,filter_name,current_min,current_max) {
//            console.log(filter_name+"->"+current_min);
//            $( "#"+slider_id ).slider({
//              range: true,
//              min: min_val,
//              max: max_val,
//              values: [ current_min , current_max ],
//              slide: function( event, ui ) {
//                $( "#"+min_display ).html(  ui.values[ 0 ] + " " + unit_of_measure);
//                $( "#"+max_display ).html( ui.values[ 1 ] + " " + unit_of_measure);
//              },
//              step: 0.1,
//              change: function(event, ui) {
//
//               var filter_spec = "fr."+filter_name;
//               var filter_spec_value = ui.values[ 0 ] + "-" + ui.values[ 1 ];
//               window.location.assign(change_query_string(filter_spec,filter_spec_value));
//
//             }
//
//            });
//
//            $( "#"+min_display ).html($( "#"+slider_id ).slider( "values", 0 ) + " " + unit_of_measure );
//            $( "#"+max_display ).html( $( "#"+slider_id ).slider( "values", 1 ) + " " + unit_of_measure );
//
//



            var html5Slider = document.getElementById(slider_id);

            noUiSlider.create(html5Slider, {
                start: [ current_min, current_max ],
                connect: true,
                range: {
                    'min': min_val,
                    'max': max_val
                }
            });

            var nodes = [
                document.getElementById(min_display), // 0
                document.getElementById(max_display)  // 1
            ];

            // Display the slider value and how far the handle moved
            // from the left edge of the slider.
            html5Slider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
                nodes[handle].innerHTML = values[handle] + " " + unit_of_measure;
            });

            html5Slider.noUiSlider.on('end', function(values){

                $('#spinner').show();

                console.log(values);

                var filter_spec = "fr."+filter_name;
                var filter_spec_value = values[ 0 ] + "-" + values[ 1 ];
                window.location.assign(change_query_string(filter_spec,filter_spec_value));
            });



        }


        //================= End of  Genetal price range initializer =============

        function generate_filter_element_url(element_id,parent_element_id,encoded_spec_value,actual_spec_value) {
            // console.log(encoded_spec_value);
            var filter_spec = "f."+parent_element_id;
            

           var sepc_divs = $('#'+parent_element_id).find( "a.active-checked" );
           var selected_specs_array = [];
           $.each(sepc_divs, function( index, value ) {
                var new_value = $(value).find('span').text().trim();
                selected_specs_array.push(new_value);
            });

           var actual_spec_value = encoded_spec_value.trim();
           if (jQuery.inArray(actual_spec_value , selected_specs_array)!='-1') { //found the current element in the list of selected elements
                //remove it
                selected_specs_array.splice($.inArray(actual_spec_value, selected_specs_array),1);
            } else {    //did not find the current element in the list of selected elements
                //add it as the next parameter
                selected_specs_array.push(encoded_spec_value);
            }

           var selected_specs = selected_specs_array.join();


           var filter_spec_value = selected_specs;
           
           var new_url = change_query_string( filter_spec , filter_spec_value );
            // console.log(new_url);
            $('#'+element_id).attr('href',new_url);
        }

    </script>
@stop