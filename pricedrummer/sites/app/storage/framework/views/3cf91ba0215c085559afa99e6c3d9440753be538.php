<?php $__env->startSection('title'); ?> PriceDrummer - All Categories <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>

    <meta name="keywords" content="Compare Prices, PriceDrummer <?php echo e($country_name); ?> price comparison engine, compare prices, online product reviews, best product deals, lowest price comparison, online shopping guide. PriceDrummer <?php echo e($country_name); ?>" />
    <meta name="description" content="PriceDrummer <?php echo e($country_name); ?>. Compare <?php echo e($country_name); ?> prices, read user and expert product reviews and use our range of easy price comparison tools to help you find the best and cheapest online shopping deals around at PriceDrummer <?php echo e($country_name); ?>" />
    <meta property="og:description" content="Compare and find best prices for everything in <?php echo e($country_name); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-lg-2 rm-pad">
                <div class="handle_category">
                    <div><?php echo $__env->make('pages.static.shared.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
                </div> <!-- end handle category div -->
            </div> <!-- end col-*-2 div -->
            <div class="col-md-8 col-lg-8" style="margin-top: 10px;">
                <div class="tab-content">
                    <div id="contact" class="tab-pane active fade in">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h1 style="font-size: 1.5em; margin-top: 5px; margin-bottom: 0;">Categories A-Zs</h1>
                            </div> <!-- end panel heading div -->
                            <div class="panel-body" style="min-height: 575px;">
                                <p>Alphabetical list of categories:</p>
                                <div class="col md-12 col-sm-12 col-xs-12 no-padding">
                                    <ul class="filter">
                                        
                                        
                                            
                                        
                                        
                                    </ul>
                                </div>
                                <div class="spinner" style="display: none;">
                                    <img src="img/loading.gif" style="margin: 10% auto auto 47%;">
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 no-padding">

                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-4 col sm-6 col-lg-4 no-padding filter-list">
                                            <a href="/filter/<?php echo e($category->category_id); ?>/<?php echo e(ReformatID(spacelessUrl(lowercase( $category->name )))); ?>">
                                                <?php echo e($category->name); ?>

                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div> <!-- end panel body div -->
                        </div> <!-- end panel div -->
                    </div> <!-- end contact div -->
                </div> <!-- end tab content div -->
            </div> <!-- end col-*-8 div -->

        </div> <!-- end row div -->
    </div> <!-- end container div -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>