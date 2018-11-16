<?php $__env->startSection('title'); ?> TV prices - Compare TVs deals when buying a television <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="keywords"
          content="Compare prices on TVs, Cheap TVs online, reviews on TVs, TVs, discount TVs, Cheapest TVs, PriceDrummer Ghana"/>
    <meta name="description" content="Compare prices on TVs on PriceRunner to help you find the best deal online"/>
    <meta property="og:title" content="TVs - Best deals on PriceDrummer Ghana"/>
    <meta property="og:url" content="http://gh.pricedrummer.com/filter/19/tvs"/>
    <meta property="og:description" content="Compare and find best prices for everything in Ghana."/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container" style="margin-top: 15px;">
        <!-- Breadcrumb begins -->
        <div class="row">
            <div class="no-padding col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin-top: -10px;">
                <div class="bread-crumb">
                    <ul>
                        <li class="bc-home"><a href="/">PriceDrummer</a></li>
                    </ul>
                </div>
            </div>
        </div> <!-- end row div -->
        <!-- Breadcrumb ends here -->

        <div class="row">
            <!-- Main Filter Sidebar (Make it off-canvas on mobile) -->
            <div id="filterBar" class="col-md-3 hidden-xs col-lg-3 hidden-sm" style="margin-left: -15px; margin-top: -20px;">
                <div class="shop-sidebar">
                    <!--TEXT WIDGET -->
                    <div class=" text-widget">
                        <h3>FILTER</h3>
                    </div>
                    <!--RANE WIDGET-->

                    <div style="font-size: 13px;margin: 0;padding: 0 0 8px 0;border-bottom: #2197C9 3px solid;">
                        <h3 style="margin: 0 0 7px 10px;">Other Matching Categories</h3>
                        <p style="margin: 0;">
                            <a onclick="closeCanvas();" href="" style="color: #2197C9; margin: 8px 10px;">Category
                                Name</a>
                        </p>
                    </div>

                    <div style="font-size: 13px;margin: 0;padding: 10px 0 8px 0;border-bottom: #2197C9 3px solid;">
                        <h3 style="margin: 0 0 7px 10px;">Other Related Categories</h3>
                        <p style="margin: 0;">
                            <a onclick="closeCanvas();" href="" style="color: #2197C9; margin: 8px 10px;">Category
                                Name</a>
                        </p>
                    </div>

                    <div class="rance-wrapper" id="PriceRangeSlider">
                        <div class="row MyFilterSlider">
                            <div class="col-md-6 no-padding">
                                <span class="minPrice pull-left"><strong> Min Value</strong></span>
                            </div>
                            <div class="col-md-6 no-padding">
                                <span class="maxPrice pull-right"><strong>Max Value</strong></span>
                            </div>
                        </div>

                        <span ng-show="ShowPriceSlidePrice">
                    <rzslider rz-slider-model="slider.minValue"
                              rz-slider-high="slider.maxValue"
                              rz-slider-options="slider.options"></rzslider></span>
                    </div> <!-- end rance wrapper div -->

                    <button style="display: none;" ng-click="routto('/filter/39/mobile-phones')">Click Me</button>

                    <!--TAG WIDGET-->
                    <div class="coupon-accordion">
                        <div class="search_display">
                            <input placeholder="Search..." id="s" ng-model="InputSearchFilter"
                                   my-enter="getData(currentPage);">
                            <button class="button1" type="submit">
                            </button>
                        </div>
                        <!--
                            From the loop below, Set the input checkbok ot an undersore replaced string of the spec and the spec option
                            This is done so that each chekbox in a particular section will be unique
                        -->
                        <div ng-repeat="spec in filter_specs | uniqueArray:'detail_name'| orderBy: 'order_index' | limitTo : 2 : 0 "
                             ng-hide="spec.detail_name == 'Model' && categoryId != 1059">
                            <h3 class="show filter-heading" onclick="ToggleFilterSpecs($(this).find('.Ftitle').text())">
                                <i id="head-icon" class="fa fa-minus-circle" aria-hidden="true"></i>
                                Spec Detail Name
                                <span class="Ftitle" style="display: none;">Spec Detail Name</span>
                            </h3>
                            <div id="" class="coupon-checkout">
                                <div class="scrollbar"></div>
                                <div>
                                    <div class="catagory-list">
                                        <ul>
                                            <li>
                                                <div class="checkbox checkbox-primary">
                                                    <input id="" onclick="" title="" class="styled" type="checkbox"/>
                                                    <label for="">
                                                    </label>
                                                    <span class="FtitleOption" style="">asassaas</span>
                                                    <span class="Ftion" style="display: none;"></span>
                                                </div>

                                            </li>


                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!--CATEGORY WIDGET-->
                        <div>
                            <h3 class="show filter-heading" onclick="ToggleFilterSpecs($(this).find('.Ftitle').text())">
                                <i id="head-icon" class="fa fa-plus-circle" aria-hidden="true"></i>
                                <span class="Ftitle" style="">Spec Detail Name</span>
                            </h3>

                            <div id="" class="coupon-checkout-content">
                                <div class="shop-catagories">
                                    <div class="catagory-list">
                                        <ul>
                                            <li>
                                                <div class="checkbox checkbox-primary" style="">
                                                    <input id=""
                                                           onclick=""
                                                           class="styled" type="checkbox"/>
                                                    <label for="">
                                                    <!--<span class="count"> ({{specOption.count}})</span>-->
                                                    </label>
                                                    <span style="">Spec Detail Value Length</span>
                                                    <span class="FtitleOption" style=""></span>
                                                    <span class="Ftion" style=""></span>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--FEATURED PRODUCT-->

                </div>
            </div> <!-- end col-md-3 div -->
            <!-- Main Filter Sidebar ends here -->

            <!-- Main content (widthL 65%; margin-left: -15px) -->
            <div class="col-md-7 col-lg-7 no-padding col-sm-12 col-xs-12" style="; margin-top: -20px;">
                <div class="spinner" style="display: none;"><img ng-src='img/loading.gif' style="margin: 10% auto auto 47%;"/></div>

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
                        <div class="container-fluid">
                            <p class="tab_cont">
                                <!-- Buying Guide Content Goes here -->
                            </p>
                            <span>Buying Guide Heading</span>
                            <p>
                                <img style="float: left; border: 10px solid beige; padding: 5px; margin: 0 8px; max-height: 120px;"
                                     src="">
                                <span class="guide_content">Buying Guide Content</span>
                            </p>
                        </div>
                    </div>

                </div> <!-- end tab content div -->
                <!--Tab content ends here -->

                <!-- Shop area begins here -->
                <div class="shop-area">
                    <div class="shop-short-wrapper clearfix">

                        <div class="shop-sort clearfix">
                            <ul class="pull-left" style="font-size: 12px; padding: 10px;">
                                <li style="margin-left: 5px; font-weight: 600;">10 products
                                </li>
                            </ul>
                            <ul class="grid-list-button clearfix">
                                <li id="listView"  class="active">
                                    <a href="/list">
                                        <i class="fa fa-th-list"></i> List View
                                    </a>
                                </li>
                                <li id="gridView" >
                                    <a href="/grid">
                                        <i class="fa fa-th"></i>Grid View
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div> <!-- end shop-short-wrapper div -->

                    <div class="tab-content">
                        <div id="grid" class="row tab-pane fade in">
                            <div class="col-md-12 col-lg-12 col-xs-12" style="margin-left: -15px;">

                                <div style="display: none;">
                                    <div style="text-align: center;"><br/>
                                        <h1>No Products</h1></div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-6">
                                    <div class="single-product">
                                        <div class="product-image">
                                            <div class="show-img">
                                                <a href="/compare">
                                                    <img ng-src=""
                                                         alt="image"></a>
                                            </div> <!-- end show-img div -->
                                        </div> <!-- end product-image div -->
                                        <div class="prod-info">
                                            <h2 class="pro-name"><a href="/compare">Product Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <div class="price"><span>Price
                                                    </span></div>
                                            </div>
                                            <div class="actions">
												<span class="add-to-cart">
													<!--If there is only one merchant/retailer then goto store else compare page-->
													<div href="" target="blank">
                                                        <form action="redirect/" method="POST"
                                                              target="_blank" id="imageParameters">
                                                            <?php echo e(csrf_field()); ?>

                                                            <input type="hidden" name="merchant_url"
                                                                   value=""/>
                                                            <input type="hidden" name="merchant_logo"
                                                                   value=""/>
                                                            <input type="hidden" name="merchant_id"
                                                                   value=""/>
                                                            <input type="hidden" name="category_id"
                                                                   value=""/>
                                                            <input type="hidden" name="CurrentUserIP"
                                                                   value=""/>
                                                            <input type="hidden" name="CurrentUserCountry"
                                                                   value=""/>
                                                            <button type="submit" class="store">Go to Store</button>
                                                        </form>
                                                    </div>

												</span>
                                                <div class="ret_ail">
                                                    <span>5 Prices</span>
                                                </div>
                                            </div>

                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div> <!-- end prod-info div -->
                                    </div> <!-- end single-product div -->
                                </div> <!-- end col-sm-4 col-md-3 col-lg-3 col-xs-6 div -->
                            </div> <!-- end col-md-12 col-lg-12 col-xs-12 div -->

                        </div> <!-- end grid div -->

                        <div id="list" class="tab-pane fade in active">
                            <div class="product-list">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="single-list-product" style="height: 100px;">
                                                <div class="col-sm-2 col-md-2 col-lg-2 col-xs-3">
                                                    <div class="show-img">
                                                        <a href="/compare">
                                                            <img src="http://placehold.it/350x300" alt="image" title="Product Name">
                                                        </a>
                                                    </div>

                                                </div>

                                                <div class="col-sm-7 col-md-7 col-lg-7 col-xs-7">
                                                    <div class="prod-list-detail">
                                                        <div class="prod-info1">
                                                            <h3 class="pro_name">
                                                                <a href="/compare">Product Name</a>
                                                            </h3>
                                                            <div class="rating">
                                                                <i class="fa fa-star"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="hidden-xs hidden-sm hidden-lg hidden-md">
                                                    <a href="/compare">
                                                        <h3 class="mf-prod-title">Product Name</h3>
                                                    </a>
                                                    <span class="mf-price">Price</span>
                                                    <span>5 Prices</span>
                                                    <div class="mf-rating">
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 col-md-3 col-lg-3 hidden-xs"
                                                     style="">
                                                    <div class="actions">
                                                        <div class="actions_aling">
                                                            <span class="pri_range">Min Price</span>
                                                            <br>
                                                            <div class="add-to-cart">
                                                                <a href="/compare" target="_blank">
                                                                    <form action="redirect/" method="POST"
                                                                          target="_blank">
                                                                        <?php echo e(csrf_field()); ?>

                                                                        <input type="hidden" name="merchant_url"
                                                                               value=""/>
                                                                        <input type="hidden" name="merchant_logo"
                                                                               value=""/>
                                                                        <input type="hidden" name="merchant_id"
                                                                               value=""/>
                                                                        <input type="hidden" name="category_id"
                                                                               value=""/>
                                                                        <input type="hidden" name="CurrentUserIP"
                                                                               value=""/>
                                                                        <input type="hidden" name="CurrentUserCountry"
                                                                               value=""/>
                                                                        <button type="submit" class="store">Go to
                                                                            Store
                                                                        </button>
                                                                    </form>
                                                                </a>
                                                                <a href="/compare">
                                                                    <span>2 Prices</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end list div -->

                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <!-- Pagination goes here -->
                        </div>

                    </div> <!-- end tab content div -->

                </div> <!-- end shop area div -->
                <!--Shop area ends here -->


            </div> <!-- end col-md-7 div -->
            <!-- Main content ends here -->
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>