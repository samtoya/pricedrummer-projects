<?php $__env->startSection('title'); ?> <?php echo e($compare_product->name); ?> - Compare <?php echo e($compare_product->name); ?> Best Prices - PriceDrummer <?php echo e($country_name); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="keywords"
          content="Buy a <?php echo e($compare_product->name); ?> online, TVs, Compare <?php echo e($compare_product->name); ?> prices, cheap Samsung TVs - PriceDrummer <?php echo e($country_name); ?>"/>
    <meta name="description"
          content="Compare <?php echo e($compare_product->name); ?> prices among hundreds of merchants, read reviews for <?php echo e($compare_product->name); ?>. Use PriceDrummer's easy TVs price comparison tools to help you find the best value <?php echo e($compare_product->name); ?> TVs online."/>
    <meta property="og:title" content="<?php echo e($compare_product->name); ?> – Best deals on PriceRunner UK"/>
    <meta property="og:url" content="<?php echo e(url()->current()); ?>"/>
    <meta property="og:description"
          content="Find the cheapest prices on this <?php echo e($compare_product->name); ?> on PriceDrummer <?php echo e($country_name); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
        
            
                
                    
                        
                            
                            
                                
                                    
                                
                                    
                                
                                    
                                
                            
                        
                    
                
            
        
    

    <!--start category slider area-->
    <div class="container" style="margin-top: 15px;">
        <!-- Breadcrumb begins -->
        <div class="row">
            <div class="no-padding col-md-12 col-sm-12 hidden-xs col-lg-12" style="margin-top: -7px;">
                <div class="breadcrumb">
                    <div class="bread-crumb">
                        <ul>
                            <li class="bc-home"><a href="<?php echo e(url('/')); ?>">PriceDrummer</a></li>
                            <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($loop->first): ?>
                                    <li class="bc-home"><a href="/category/<?php echo e($breadcrumb->category_id); ?>/<?php echo e(spacelessUrl(lowercase($breadcrumb->name))); ?>"><?php echo e($breadcrumb->name); ?></a></li>
                                <?php elseif($loop->last): ?>
                                    <li class="bc-home"><a href="/filter/<?php echo e($breadcrumb->category_id); ?>/<?php echo e(spacelessUrl(lowercase($breadcrumb->name))); ?>"><?php echo e($breadcrumb->name); ?></a></li>
                                <?php else: ?>
                                    <li class="bc-home breadcrumb-not-last"><?php echo e($breadcrumb->name); ?></li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li class="bc-home breadcrumb-last"><?php echo e($compare_product->name); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- end row div -->
        <!-- Breadcrumb ends here -->
        <div class="row" style="margin-top: 35px;">
            <!--slider coloum-->
            <div class="no-padding col-md-10 col-xs-12">
                <section>
                    <div class="row" style="margin-top: -20px;">
                        <div class="col-md-12">
                            <div class="shop-area">
                                <div class="single-list-product1">
                                    <div class="col-md-4 col-sm-4 col-sm-4 col-xs-4">
                                        <a class="img-icon hidden-xs" data-toggle="modal" data-target="#product_image">
                                            <i class="fa fa-picture-o" aria-hidden="true"></i>
                                            <?php echo e($total_images); ?>

                                        </a>

                                        <a data-target="#product_image" data-toggle="modal">
                                            
                                            <img style="height: 210px; display: block; padding: 0 0 20px;margin-left: 0;"
                                                 src="//pricedrummer.com/images/static/product_images/medium/<?php echo e($compare_product->image); ?>.png"
                                                 alt="<?php echo e($compare_product->name); ?>'s image"
                                                 title="<?php echo e($compare_product->name); ?>">
                                        </a>
                                    </div>

                                    <div class="col-sm-8 col-md-8 col-sm-8 col-xs-8">
                                        <div class="prod-list-detail">
                                            <div class="prod-info" style="text-align:left;">
                                                <h1 class="ret_content">
                                                    <?php echo e($compare_product->name); ?>

                                                </h1>
                                                <div class="price-box">
                                                    <div class="price">
                                                        <span class="range">Lowest: Gh&cent;<?php echo e(sprintf("%.2f", $compare_product->min_price)); ?></span>
                                                    </div>

                                                </div>
                                                <div class="ret_lair">
                                                    <span>
                                                        <a href=""><?php echo e($compare_product->prices_count); ?> <?php echo e(str_plural('price', $compare_product->prices_count)); ?></a>
                                                    </span>
                                                </div>

                                                <div class="rating">
                                                    <?php for($j=0; $j <=4; $j++): ?>
                                                        <i class="fa fa-star-o"></i>
                                                    <?php endfor; ?>
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
                                            <?php $__currentLoopData = $products_retailers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $retailer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="text-align: center; padding: 10px 5px;">
                                                        <?php if( $retailer->is_offline == 0 ): ?>
                                                            <img src="//pricedrummer.com/images/static/merchants/ghana/<?php echo e($retailer->merchant_id); ?>.jpg" style="max-width: 70%;">
                                                        <?php elseif( $retailer->is_offline == 1 ): ?>
                                                            <img src="//pricedrummer.com/images/static/retailers/ghana/<?php echo e($retailer->merchant_id); ?>.jpg" style="max-width: 70%;">
                                                        <?php endif; ?>

                                                        <div class="rating visible-xs">
                                                            <?php for($i=0; $i <= 4; $i++): ?>
                                                                <i class="fa fa-star-o"></i>
                                                            <?php endfor; ?>
                                                        </div>
                                                    </td>

                                                    <td style="text-align: center;vertical-align: middle;"
                                                        class="hidden-xs">
                                                        <div>
                                                            <div class="rating">
                                                                <?php for($i=0; $i <= 4; $i++): ?>
                                                                    <i class="fa fa-star-o"></i>
                                                                <?php endfor; ?>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td style="text-align: center; vertical-align: middle;"
                                                        class="hidden-xs">
                                                        <?php if( $retailer->is_offline == 0 ): ?>
                                                            <h5 class="descrip" title=""><?php echo e($retailer->product_name); ?></h5>
                                                        <?php elseif( $retailer->is_offline == 1 ): ?>
                                                            <h5 class="descrip" title=""><?php echo e($retailer->description); ?></h5>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td class="price_table"
                                                        style="text-align: center;vertical-align: middle;">
                                                        <div>
                                                            <strong class="pri_ce">Gh&cent; <?php echo e(sprintf("%.2f", $retailer->price)); ?></strong>
                                                        </div>
                                                    </td>

                                                    <td style="text-align:left; vertical-align: middle;padding-right: 15px;" class="change_btn_co">
                                                        <a target="_blank" href="/redirect/<?php echo e($retailer->product_ID); ?>" class="btn btn-warning">Go to Store</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                            <?php $__currentLoopData = $product->sc_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div>
                                                    <table class="table">
                                                        <tr style="border: none;">
                                                            <?php if( $key == 0 ): ?>
                                                                <td style="border: none;">
                                                                    <h4 style="margin: 20px 0 2px;"><?php echo e($spec->category_section); ?></h4>
                                                                </td>
                                                            <?php elseif($key > 0): ?>
                                                                <td style="border: none;">
                                                                    <?php if( $product->sc_detail[$key-1]->category_section != $spec->category_section ): ?>
                                                                        <h4 style="margin: 20px 0 2px;"><?php echo e($spec->category_section); ?></h4>
                                                                    <?php endif; ?>
                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>
                                                        <tr>
                                                            <?php if( $spec->detail_name == "Video Link"): ?>
                                                                <?php continue; ?>
                                                            <?php else: ?>
                                                                <td style="width: 50%; padding-top: 10px; padding-bottom: 10px;">
                                                                    <?php echo e($spec->detail_name); ?>

                                                                </td>
                                                                <td style="border-left: 1px solid #CCCCCC; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">
                                                                    <?php echo e(ReformatHTML($spec->details_value)); ?>

                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>
                                                    </table>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        </div>
    </div>

    
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

                                                <?php $__currentLoopData = $product_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <img class="SilDImg"
                                                             src="http://www.pricedrummer.com/images/static/product_images/large/<?php echo e($product_image->image_id); ?>.png" alt="""/>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
                                                <?php $__currentLoopData = $product_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <img class="galImg"
                                                             src="http://www.pricedrummer.com/images/static/product_images/thumbs/<?php echo e($product_image->image_id); ?>.png" alt=""/>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
                                    <span ><?php echo $product_video_link; ?></span>
                                </div>
                            </div>
                            <p></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>