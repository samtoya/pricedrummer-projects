<?php $__env->startSection('title'); ?> Compare Prices - Smart Shopping in <?php echo e($country_name); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="keywords"
          content="PriceDrummer, <?php echo e($country_name); ?>,  price compare, price comparison, deals, product reviews, lowest prices, online shopping, forum, e-commerce, electronics"/>
    <meta name="description"
          content="Compare and find best prices for everything in <?php echo e($country_name); ?>. Save money on mobile phones, computers, cameras, fashion, TVs, laptops, furniture, washing machine. Smart Shopping"/>
    <meta name="content-language" content=en/>
    <meta property="og:description" content="Compare and find best prices for everything in <?php echo e($country_name); ?>."/>
    <meta property="og:title" content="http://pricedrummer.com"/>
    <meta property="og:url" content="http://pricedrummer.com"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="handle_home_section">
        <section class="container">
            <div class="row">
                
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
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <h3>
                                                        <a href="/category/<?php echo e($category->category_ID); ?>/<?php echo e(spacelessUrl(lowercase( $category->name ))); ?>">
                                                            <img src="<?php echo e(asset('/img/category_icons/' . ReformatID($category->name) . '.png')); ?>"
                                                                 alt=""><?php echo e($category->name); ?>

                                                        </a>
                                                    </h3>
                                                    <ul>
                                                        <?php $__currentLoopData = $category->category_children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category_lev3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li>
                                                                <a class="nav-action"
                                                                   href="/filter/<?php echo e($category_lev3->category_ID); ?>/<?php echo e(spacelessUrl(lowercase( $category_lev3->name ))); ?>"><?php echo e($category_lev3->name); ?>, </a>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <li><a class="nav-action"
                                                               href="/category/<?php echo e($category->category_ID); ?>/<?php echo e(spacelessUrl(lowercase( $category->name ))); ?>">View
                                                                More</a></li>
                                                    </ul>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="see-all_category"><a href="<?php echo e(url('/all_categories')); ?>">see all <i
                                                class="fa fa-angle-right" aria-hidden="true"></i><i
                                                class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-8 col-md-8 hidden-xs" style="margin-left: 0;">
                    <div class="handle_slider" style="margin-bottom: 15px;">
                        <div id="home_slides_control">

                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li data-target="#myCarousel" data-slide-to="<?php echo e($key); ?>" <?php if ( $key == 0 ) {
											echo "class='active'";
										}?> ></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">

                                    <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item <?php if ( $key == 0 ) {
											echo 'active';
										}?> ">
                                            <a href="<?php echo e($slide->url); ?>"><img src="<?php echo e($slide->image); ?>"
                                                                           style="margin:auto;width: 750px;height: 326px;"></a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
                                    <?php $__currentLoopData = $home_quick_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-4 col-lg-4 col-sm-6 no-padding panel-widget-thumbs">
                                            <h5><?php echo e($category->name); ?></h5>
                                            <div class="col-md-4 col-sm-3 no-padding"><img
                                                        alt="<?php echo e($category->name); ?>'s image"
                                                        src="<?php echo e(asset('img/60x60/' . $category->image)); ?>"
                                                        title="<?php echo e($category->name); ?>">
                                            </div>
                                            <div class="col-md-8 col-sm-9 no-padding">
                                                <ul class="panel-widget-categories">
                                                    <?php $__currentLoopData = $category->sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li>
                                                            <a href="<?php echo e($sub_category->url); ?>">
                                                                <?php echo e($sub_category->shortname); ?><?php echo e($loop->last ? "" : ","); ?>

                                                            </a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 no-padding" style="padding-right: 0;">
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
                    <div class="col-md-6 col-sm-6 hidden-xs" style="padding-right: 0px;">
                        <div class="social-media-area">
                            <div class="panel panel-default">
                                <div class="panel-body" style="padding:0;">
                                    <div class="fb-page" data-href="https://www.facebook.com/PriceDrummerGH"
                                         data-tabs="timeline" data-width="358" data-height="215"
                                         data-small-header="false" data-adapt-container-width="true"
                                         data-hide-cover="false" data-show-facepile="true">
                                        <blockquote cite="https://www.facebook.com/PriceDrummerGH"
                                                    class="fb-xfbml-parse-ignore"><a
                                                    href="https://www.facebook.com/PriceDrummerGH">PriceDrummer.com -
                                                compare prices in Ghana</a></blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-2 nopadding"></div>
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
                                        <?php $__currentLoopData = $top_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-3 col-sm-3 col-xs-6"
                                                 style="padding: 2px; overflow:hidden;">
                                                <div onmouseover="showSubCat(this);" onmouseleave="hideSubCat(this)"
                                                     class="cat_paddin top_Cats"
                                                     style='background-image: url("img/<?php echo e($category->image); ?>");'>
                                                    <a href="">
                                                        <h3><?php echo e($category->name); ?></h3></a>
                                                    <div style="" class="CategorySub hide_sub-cat">
                                                        <h3><?php echo e($category->name); ?></h3>
                                                        <ul class="topcats">
                                                            <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category_sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li><a
                                                                            href="/filter/<?php echo e($category_sub->id); ?>/<?php echo e(spacelessUrl(lowercase( $category_sub->name ))); ?>"
                                                                            class="top_categories_catzero_link"><?php echo e($category_sub->shortname); ?></a>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="hidden-lg hidden-sm hidden-md col-xs-12">
                                <div class="popular category_area">
                                    <div class="category-widget-wrapper">
                                        <div class="category-widget">
                                            <div class="category-widget-heading">
                                                <h2 class="category-title">Compare Prices</h2></div>
                                            <div class="category-widget-content">
                                                <ul>
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <span>
                                                            <a href="/category/<?php echo e($category->category_ID); ?>/<?php echo e(spacelessUrl(lowercase( $category->name ))); ?>">
                                                                <li>
                                                                    <img style="margin-right: 10px;"
                                                                         src="<?php echo e(asset('/img/category_icons/' . ReformatID($category->name) . '.png')); ?>"><?php echo e($category->name); ?>

                                                                    <span
                                                                            style="display: inline-block; line-height: 0; margin-top: 10px;"
                                                                            class="fa fa-angle-right pull-right"
                                                                            aria-hidden="true">
                                                                    </span>
                                                                </li>
                                                </a>
                                                </span>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>