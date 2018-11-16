<div class="shop-sidebar">
    <!--TEXT WIDGET -->
    <div class=" text-widget">
        <h3>FILTER</h3>
    </div>

    <!--RANGE WIDGET-->
    @if(count($MatchingCategories) > 0)
        <div style="font-size: 13px;margin: 0;padding: 0 0 8px 0;border-bottom: #2197C9 3px solid;">
            <h3 style="margin: 0 0 7px 10px;">Other Matching Categories</h3>
            @foreach($MatchingCategories as $category)
                <p style="margin: 0;">
                    <a onclick="closeCanvas();"
                       href="/filter/{{$category->category_id}}/search?search=<?php if(isset($_GET['search'])){echo $_GET['search'];}?>&view={{$view}}"
                       style="color: #2197C9; margin: 8px 10px;">
                        {{$category->name}}
                    </a>
                </p>
            @endforeach
        </div>
    @endif

    @if(count($RelatedCategories) > 0)
        <div style="font-size: 13px;margin: 0;padding: 10px 0 8px 0;border-bottom: #2197C9 3px solid;">
            <h3 style="margin: 0 0 7px 10px;">Other Related Categories</h3>
            @foreach($RelatedCategories as $category)
                <p style="margin: 0;">
                    <a onclick="closeCanvas();" href="/filter/{{$category->category_id}}/{{lowercase(spacelessUrl($category->name))}}" style="color: #2197C9; margin: 8px 10px;">
                        {{$category->name}}
                    </a>
                </p>
            @endforeach
        </div>
    @endif

    <div class="rance-wrapper" id="PriceRangeSlider">
        <div class="row MyFilterSlider">
            <div class="col-md-6 no-padding">
                <span class="minPrice pull-left" id="p-slider-min" style="font-weight:bold;"><strong></strong></span>
            </div>
            <div class="col-md-6 no-padding">
                <span class="maxPrice pull-right" id="p-slider-max" style="font-weight:bold;"><strong></strong></span>
            </div>
        </div>

        <span><br/>
                         <div id="slider-range"></div>
                        </span>

    </div> <!-- end rance wrapper div -->

    <!--TAG WIDGET-->
    <div class="coupon-accordion">
        <div class="search_display">
            <form autocomplete=off action="/search" method="GET" id="search_form">
                <input placeholder="Search..." id="s" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
                <button class="button1" type="submit">
                </button>
            </form>
        </div>
        <!--
            From the loop below, Set the input checkbok ot an undersore replaced string of the spec and the spec option
            This is done so that each chekbox in a particular section will be unique
        -->
        <?php $filter_count=0; ?>
        @foreach($category_details as $category_code => $category_values)
            <div>
                <h3 class="show filter-heading" onclick="ToggleFilterSpecs('{{ReformatID($category_code)}}', 'head-icon')">
                    <i id="head-icon" class="fa fa-minus-circle" aria-hidden="true"></i>
                    {{str_replace('_', ' ', explode("|", $category_code)[0])}}
                    <span class="Ftitle" style="display: none;">Spec Detail Name</span>
                </h3>
                <div id="{{ReformatID($category_code)}}" class="coupon-checkout<?php if($filter_count > 1){ echo'-content'; }?>">
                    <div class="scrollbar"></div>
                    <div>
                        <div class="catagory-list">
                            <ul>
                                <li>
                                    <div class="checkbox checkbox-primary">

                                        @if( strpos($category_code, '|range') !== false )
                                            {{-- if the value is supposed to be a range value --}}
                                            {{-- Put a slider --}}
                                            <div>{{--range slider display values--}}
                                                <span id="{{explode("|", $category_code)[0]}}-range-min"></span>
                                                <span class="pull-right" id="{{explode("|", $category_code)[0]}}-range-max"></span>
                                            </div>
                                            {{-- the range slider itself --}}
                                            <div id="{{explode("|", $category_code)[0]}}-range"></div>
                                            {{-- Prepare the range slider for initialization after the page is ready here inside the loop. this is to avoide re-writing the loop to initialize the range sliders after the page is loaded. --}}
                                            <script type="text/javascript">
                                                $( document ).ready(function() {
                                                            init_range_slider(
                                                                    "{{explode("|", $category_code)[0]}}-range",
                                                                    {{min($category_values)}},
                                                                    {{max($category_values)}},
                                                                    @if(strpos($category_code, '-') !== false)
                                                                            "{{explode("-", $category_code)[1]}}"
                                                            @else
                                                                    "{{''}}"
                                                                    @endif,
                                                                    "{{explode("|", $category_code)[0]}}-range-min",
                                                                    "{{explode("|", $category_code)[0]}}-range-max",
                                                                    "{{explode("|", $category_code)[0]}}",
                                                                    @if(isset($_GET[ 'fr_'.explode("|", $category_code)[0] ]) )
                                                                            "{{explode( "-",$_GET['fr_'.explode("|", $category_code)[0] ] )[0] }}"
                                                            @else
                                                                    "{{min($category_values)}}"
                                                                    @endif,
                                                                    @if(isset($_GET[ 'fr_'.explode("|", $category_code)[0] ]) && count(explode( "-",$_GET['fr_'.explode("|", $category_code)[0] ] )) >1 )
                                                                            "{{explode( "-",$_GET['fr_'.explode("|", $category_code)[0] ] )[1] }}"
                                                            @else
                                                                    "{{max($category_values)}}"
                                                            @endif
                                                        );

                                                });
                                            </script>

                                        @else
                                            {{-- its not a range value --}}
                                            {{-- display the values --}}
                                            <div id="{{explode("|", $category_code)[0]}}">
                                                @foreach($category_values as $key => $spec_value)
                                                    <span  class="FtitleOption" style="display: block;">
                                                                <a id="{{explode("|", $category_code)[0].$key}}"
                                                                   class='filter_option <?php if(isset($_GET[ 'f_'.explode("|", $category_code)[0] ])){
                                                                       $url_spec_values = explode(",", $_GET[ 'f_'.explode("|", $category_code)[0] ]);
                                                                       if(in_array(urlencode($spec_value), $url_spec_values)){
                                                                           echo "active-checked";
                                                                       }
                                                                   }else{
                                                                       echo "";
                                                                   }
                                                                   ?>'
                                                                   href="#" onclick="$('#spinner').show();">
                                                                    {{$spec_value}}
                                                                    <span style="display: none;">{{urlencode($spec_value)}}</span>
                                                                </a>
                                                            </span>
                                                    <script type="text/javascript">
                                                        $( document ).ready(function() {
                                                            generate_filter_element_url(
                                                                    "{{explode("|", $category_code)[0].$key}}",
                                                                    "{{explode("|", $category_code)[0]}}",
                                                                    "{{explode("|", $category_code)[0]}}",
                                                                    "d",
                                                                    "{{urlencode($spec_value)}}",
                                                                    "{{$spec_value}}"
                                                            );

                                                        });
                                                    </script>

                                                @endforeach
                                            </div>

                                        @endif
                                    </div>

                                </li>


                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <?php $filter_count++; ?>
        @endforeach

    </div>
    <!--FEATURED PRODUCT-->

</div>