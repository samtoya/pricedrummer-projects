<?php $__env->startSection('title'); ?> About PriceDrummer <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>

    <meta name="keywords" content="About PriceDrummer" />
    <meta name="description" content="About PriceDrummer" />
    <meta property="og:description" content="Compare and find best prices for everything in <?php echo e($country_name); ?>."/>
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
                                <h1 style="font-size: 1.5em; margin-top: 5px; margin-bottom: 0;">About PriceDrummer</h1>
                            </div> <!-- end panel heading div -->
                            <div class="panel-body" style="height: 575px;">
                                <p>PriceDrummer - Smart Shopping Anytime!</p>

                                <p>
                                    PriceDrummer is Ghana’s no.1  shopping comparison site that help shoppers to save money. The information we provide help shoppers to make the most informed purchasing decision about a product or service. We scan through thousands of products and several retailers and present them in a clear and orderly manner.
                                </p>

                                <p>
                                    You can compare products from mobile phones to laptops and services like travel and insurance. For every product or service you are able to use the filter tool to narrow down to a specific item and reliable product information. The  store and product reviews are also helpful.  We always show lowest prices first.
                                </p>

                                <p>
                                    <strong>Vision</strong>: PriceDrummer is committed to being the starting point for shoppers that want to save money and that it simultaneously build value for retailers. Smart Shopping Anytime!
                                </p>

                                <p>
                                    Our mission is to publish prices and relevant/reliable  information for products and services that saves shoppers money daily. We achieve this by  living our core values - Unyielding  Integrity, Passion, Innovation and Respect.
                                </p>
                            </div> <!-- end panel body div -->
                        </div> <!-- end panel div -->
                    </div> <!-- end contact div -->
                </div> <!-- end tab content div -->
            </div> <!-- end col-*-8 div -->

        </div> <!-- end row div -->
    </div> <!-- end container div -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>