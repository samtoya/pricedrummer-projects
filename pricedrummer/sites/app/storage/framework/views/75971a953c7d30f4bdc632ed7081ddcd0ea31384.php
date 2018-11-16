<?php $__env->startSection('title'); ?> <?php echo e($category_name); ?> prices - Compare <?php echo e($category_name); ?> deals when buying a <?php echo e($category_name); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="keywords"
          content="Compare prices on <?php echo e($category_name); ?>, Cheap <?php echo e($category_name); ?> online, reviews on <?php echo e($category_name); ?>, <?php echo e($category_name); ?>, discount <?php echo e($category_name); ?>, Cheapest <?php echo e($category_name); ?>, PriceDrummer <?php echo e($country_name); ?>"/>
    <meta name="description" content="Compare prices on <?php echo e($category_name); ?> on PriceDrummer to help you find the best deal online"/>
    <meta property="og:title" content="<?php echo e($category_name); ?> - Best deals on PriceDrummer <?php echo e($country_name); ?>"/>
    <meta property="og:description" content="Compare and find best prices for everything in <?php echo e($country_name); ?>."/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container" style="margin-top: 15px;">
        <!-- Breadcrumb begins -->
        <div class="row">
            <div class="no-padding col-md-12 col-sm-12 hidden-xs col-lg-12" style="margin-top: -10px;">
                <div class="breadcrumb">
                    <div class="bread-crumb">
                        <ul>
                            <li class="bc-home"><a href="<?php echo e(url('/')); ?>">PriceDrummer</a></li>
                            <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($loop->first): ?>
                                    <li class="bc-home"><a href="/category/<?php echo e($breadcrumb->category_id); ?>/<?php echo e(spacelessUrl(lowercase($breadcrumb->name))); ?>"><?php echo e($breadcrumb->name); ?></a></li>
                                <?php elseif($loop->last): ?>
                                    <li class="bc-home breadcrumb-last"><?php echo e($breadcrumb->name); ?></li>
                                <?php else: ?>
                                    <li class="bc-home breadcrumb-not-last"><?php echo e($breadcrumb->name); ?></li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- end row div -->
        <!-- Breadcrumb ends here -->

        <div class="row">
            <!-- Main Filter Sidebar (Make it off-canvas on mobile) -->
            <div id="filterBar" class="col-md-3 hidden-xs col-lg-3 hidden-sm" style="margin-left: -15px; margin-top: 20px;">
                <div class="shop-sidebar">
                    <!--TEXT WIDGET -->
                    <div class=" text-widget">
                        <h3>FILTER</h3>
                    </div>
                    <!--RANE WIDGET-->
                    <?php if(count($MatchingCategories) > 0): ?>
                        <div style="font-size: 13px;margin: 0;padding: 0 0 8px 0;border-bottom: #2197C9 3px solid;">
                            <h3 style="margin: 0 0 7px 10px;">Other Matching Categories</h3>
                            <?php $__currentLoopData = $MatchingCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p style="margin: 0;">
                                    <a onclick="closeCanvas();" 
                                        href="/filter/<?php echo e($category->category_id); ?>/search?search=<?php if(isset($_GET['search'])){echo $_GET['search'];}?>&view=<?php echo e($view); ?>" 
                                        style="color: #2197C9; margin: 8px 10px;">
                                    <?php echo e($category->name); ?>

                                    </a>
                                </p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if(count($RelatedCategories) > 0): ?>
                        <div style="font-size: 13px;margin: 0;padding: 10px 0 8px 0;border-bottom: #2197C9 3px solid;">
                            <h3 style="margin: 0 0 7px 10px;">Other Related Categories</h3>
                             <?php $__currentLoopData = $RelatedCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p style="margin: 0;">
                                    <a onclick="closeCanvas();" href="/filter/<?php echo e($category->category_id); ?>/<?php echo e(lowercase(spacelessUrl($category->name))); ?>" style="color: #2197C9; margin: 8px 10px;">
                                        <?php echo e($category->name); ?>

                                    </a>
                                </p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <div class="rance-wrapper" id="PriceRangeSlider">
                       <div class="row MyFilterSlider">
                           <div class="col-md-6 no-padding">
                               <span class="minPrice pull-left" id="p-slider-min" style="color:#f6931f; font-weight:bold;"><strong></strong></span>
                           </div>
                           <div class="col-md-6 no-padding">
                               <span class="maxPrice pull-right" id="p-slider-max" style="color:#f6931f; font-weight:bold;"><strong></strong></span>
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
                        <?php $__currentLoopData = $category_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_code => $category_values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <h3 class="show filter-heading" onclick="ToggleFilterSpecs('<?php echo e(ReformatID($category_code)); ?>')">
                                <i id="head-icon" class="fa fa-minus-circle" aria-hidden="true"></i>
                                <?php echo e(str_replace('_', ' ', explode("|", $category_code)[0])); ?>

                                <span class="Ftitle" style="display: none;">Spec Detail Name</span>
                            </h3>
                            <div id="<?php echo e(ReformatID($category_code)); ?>" class="coupon-checkout">
                                <div class="scrollbar"></div>
                                <div>
                                    <div class="catagory-list">
                                        <ul>
                                            <li>
                                                <div class="checkbox checkbox-primary">
                                                   
                                                    <?php if( strpos($category_code, '|range') !== false ): ?> 
                                                     
                                                        
                                                        <div>
                                                            <span id="<?php echo e(explode("|", $category_code)[0]); ?>-range-min"></span>
                                                            <span class="pull-right" id="<?php echo e(explode("|", $category_code)[0]); ?>-range-max"></span>
                                                        </div>
                                                        
                                                        <div id="<?php echo e(explode("|", $category_code)[0]); ?>-range"></div>
                                                        
                                                        <script type="text/javascript">
                                                            $( document ).ready(function() {
                                                                init_range_slider(
                                                                    "<?php echo e(explode("|", $category_code)[0]); ?>-range",
                                                                    <?php echo e(min($category_values)); ?>,
                                                                    <?php echo e(max($category_values)); ?>,
                                                                    <?php if(strpos($category_code, '-') !== false): ?>
                                                                        "<?php echo e(explode("-", $category_code)[1]); ?>"
                                                                    <?php else: ?>
                                                                        "<?php echo e(''); ?>"
                                                                    <?php endif; ?>,
                                                                    "<?php echo e(explode("|", $category_code)[0]); ?>-range-min",
                                                                    "<?php echo e(explode("|", $category_code)[0]); ?>-range-max",
                                                                    "<?php echo e(explode("|", $category_code)[0]); ?>",
                                                                    <?php if(isset($_GET[ 'fr_'.explode("|", $category_code)[0] ]) ): ?>
                                                                        "<?php echo e(explode( "-",$_GET['fr_'.explode("|", $category_code)[0] ] )[0]); ?>"
                                                                    <?php else: ?>
                                                                        "<?php echo e(min($category_values)); ?>"
                                                                    <?php endif; ?>,
                                                                    <?php if(isset($_GET[ 'fr_'.explode("|", $category_code)[0] ]) && count(explode( "-",$_GET['fr_'.explode("|", $category_code)[0] ] )) >1 ): ?>
                                                                        "<?php echo e(explode( "-",$_GET['fr_'.explode("|", $category_code)[0] ] )[1]); ?>"
                                                                    <?php else: ?>
                                                                        "<?php echo e(max($category_values)); ?>"
                                                                    <?php endif; ?>
                                                                );
                                                             });
                                                        </script>

                                                    <?php else: ?> 
                                                    
                                                        
                                                        <div id="<?php echo e(explode("|", $category_code)[0]); ?>">
                                                        <?php $__currentLoopData = $category_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $spec_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <span  class="FtitleOption" style="display: block;">
                                                                <a id="<?php echo e(explode("|", $category_code)[0].$key); ?>"
                                                                    class='filter_option <?php if(isset($_GET[ 'f_'.explode("|", $category_code)[0] ])){
                                                                                    $url_spec_values = explode(",", $_GET[ 'f_'.explode("|", $category_code)[0] ]);
                                                                                    if(in_array(urlencode($spec_value), $url_spec_values)){
                                                                                        echo "active-checked";
                                                                                    }
                                                                                }else{
                                                                                    echo "";
                                                                                } 
                                                                            ?>'
                                                                    href="#">
                                                                    <?php echo e($spec_value); ?>

                                                                    <span style="display: none;"><?php echo e(urlencode($spec_value)); ?></span>
                                                                </a>
                                                            </span>
                                                            <script type="text/javascript">
                                                                $( document ).ready(function() {
                                                                    generate_filter_element_url(
                                                                        "<?php echo e(explode("|", $category_code)[0].$key); ?>",
                                                                        "<?php echo e(explode("|", $category_code)[0]); ?>",
                                                                        "<?php echo e(urlencode($spec_value)); ?>",
                                                                        "<?php echo e($spec_value); ?>"
                                                                    )
                                                                });
                                                            </script>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                        
                                                    <?php endif; ?>
                                                </div>

                                            </li>


                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                    <!--FEATURED PRODUCT-->

                </div>
            </div> <!-- end col-md-3 div -->
            <!-- Main Filter Sidebar ends here -->

            <!-- Main content (width: 65%; margin-left: -15px) -->
            <div class="col-md-7 col-lg-7 no-padding col-sm-12 col-xs-12" style="width: 65%; margin-top: 20px;">
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
                        <?php $__currentLoopData = $buyers_guide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="container-fluid">
                                <p class="tab_cont">
                                    <!-- Buying Guide Content Goes here -->
                                </p>
                                <span><?php echo $guide->heading; ?></span>
                                <p>
                                    <?php if($guide->has_image == 1): ?>
                                    <img style="float: left; border: 10px solid beige; padding: 5px; margin: 0 8px; max-height: 120px;"
                                         src="http://www.pricedrummer.com/images/static/buying_guide_images/thumbs/<?php echo e($guide->id); ?>.png">
                                    <?php endif; ?>
                                    <span class="guide_content"><?php echo ReformatHTML($guide->content); ?></span>
                                </p>
                            </div><br/>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div> <!-- end tab content div -->
                <!--Tab content ends here -->


                <!-- Shop area begins here -->
                <div class="shop-area">
                    <div class="shop-short-wrapper clearfix">

                        <div class="shop-sort clearfix">
                            <ul class="pull-left" style="font-size: 12px; padding: 10px;">
                                <li style="margin-left: 5px; font-weight: 600;"><?php echo e($compare_products_data->total); ?> products
                                </li>
                            </ul>
                            <ul class="grid-list-button clearfix">
                                
                                <li class="<?php if(isset($_GET['view']) && trim($_GET['view']) =='list' ): ?>
                                                <?php echo e('active'); ?>

                                            <?php endif; ?> 
                                            ">
                                    <a id="listView" href="/list">
                                        <i class="fa fa-th-list"></i> List View
                                    </a>
                                </li>

                                <li class="<?php if(isset($_GET['view']) && trim($_GET['view']) =='grid' ): ?>
                                                <?php echo e('active'); ?>

                                            <?php elseif( !isset($_GET['view']) ): ?>
                                                <?php echo e('active'); ?>

                                            <?php endif; ?> 
                                            ">
                                    <a id="gridView" href="/grid">
                                        <i class="fa fa-th"></i>Grid View
                                    </a>
                                </li>

                                
                                    
                                        
                                    
                                
                                
                                    
                                        
                                    
                                
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
                        <?php if($view=='grid'): ?>
                            <?php echo $__env->make('pages.dynamic.filter_grid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php elseif($view=='list'): ?>
                            <?php echo $__env->make('pages.dynamic.filter_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php else: ?>
                            <?php echo $__env->make('pages.dynamic.filter_grid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>


                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xs-12">
                                <?php echo $__env->make('pages.dynamic.filter_pagination', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>

                    </div> <!-- end tab content div -->

                </div> <!-- end shop area div -->
                <!--Shop area ends here -->


            </div> <!-- end col-md-7 div -->
            <!-- Main content ends here -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script>
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
        $( "#slider-range" ).slider({
          range: true,
          min: <?php echo e($min_price); ?>,
          max: <?php echo e($max_price); ?>,
          values: [ <?php if(isset($_GET['min_price']) && is_numeric ( trim($_GET['min_price']) ) ): ?>
                        <?php echo e($_GET['min_price']); ?>

                    <?php else: ?>
                        <?php echo e($min_price); ?>

                    <?php endif; ?> ,
                    <?php if(isset($_GET['max_price']) && is_numeric ( trim($_GET['max_price']) ) ): ?>
                        <?php echo e($_GET['max_price']); ?>

                    <?php else: ?>
                        <?php echo e($max_price); ?>

                    <?php endif; ?> ],
          slide: function( event, ui ) {
            $( "#p-slider-min" ).html( "<?php echo e($country_currency); ?>" + ui.values[ 0 ] );
            $( "#p-slider-max" ).html( "<?php echo e($country_currency); ?>" + ui.values[ 1 ] );
          },
          change: function(event, ui) {
           /*
           Show Preloader
           Update query string values 
           Load new page
           */
           $('#spinner').show();
           
           var min_max = {
            'min_price': ui.values[ 0 ],
            'max_price': ui.values[ 1 ]
           };
           window.location.assign(change_query_string_obj(min_max))

         }

        });

        $( "#p-slider-min" ).html( "<?php echo e($country_currency); ?>" + $( "#slider-range" ).slider( "values", 0 ) );
        $( "#p-slider-max" ).html( "<?php echo e($country_currency); ?>" + $( "#slider-range" ).slider( "values", 1 ) );

        } );

        $('#gridView').attr('href',change_query_string('view','grid'));
        $('#listView').attr('href',change_query_string('view','list'));

        //============= Genetal price range initializer ================
        function init_range_slider(slider_id,min_val,max_val,unit_of_measure,min_display,max_display,filter_name,current_min,current_max) {
//            console.log(filter_name+"->"+current_min);
            $( "#"+slider_id ).slider({
              range: true,
              min: min_val,
              max: max_val,
              values: [ current_min , current_max ],
              slide: function( event, ui ) {
                $( "#"+min_display ).html(  ui.values[ 0 ] + " " + unit_of_measure);
                $( "#"+max_display ).html( ui.values[ 1 ] + " " + unit_of_measure);
              },
              step: 0.1,
              change: function(event, ui) {

               var filter_spec = "fr."+filter_name;
               var filter_spec_value = ui.values[ 0 ] + "-" + ui.values[ 1 ];
               window.location.assign(change_query_string(filter_spec,filter_spec_value));

             }

            });

            $( "#"+min_display ).html($( "#"+slider_id ).slider( "values", 0 ) + " " + unit_of_measure );
            $( "#"+max_display ).html( $( "#"+slider_id ).slider( "values", 1 ) + " " + unit_of_measure );

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>