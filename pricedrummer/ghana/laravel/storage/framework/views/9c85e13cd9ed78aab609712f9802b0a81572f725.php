<?php $__env->startSection('title'); ?> Get in Touch with us at PriceDrummer <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>

    <meta name="keywords" content="Get in touch with us at PriceDrummer">
    <meta name="description" content="Get in touch with us at PriceDrummer" />
    <meta property="og:description" content="Compare and find best prices for everything in Ghana."/>
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
                                <h1 style="font-size: 1.5em; margin-top: 5px; margin-bottom: 0px;">Contact</h1>
                                <span>If you will like to get more information</span>
                            </div> <!-- end panel heading div -->
                            <div class="panel-body">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                    <div ng-if="COUNTRY == 'Ghana'"
                                         id="google-map" style="margin-bottom: 20px;">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.094862248633!2d-0.1881810849277275!3d5.552954135223458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdf907d1262400b%3A0x2ba097b5c1029fec!2sLokko+Rd%2C+Accra!5e0!3m2!1sen!2sgh!4v1474362572216" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                                    </div> <!-- end google map div -->
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 no-padding">
                                    <h3>General inquiries (shoppers)</h3>
                                    <p><a href="mailto:support@pricedrummer.com">support@pricedrummer.com</a></p>
                                    <h3>Retailers/Merchants</h3>
                                    <p><a href="mailto:retail@pricedrummer.com">retail@pricedrummer.com</a></p>
                                    <h3>Advertising</h3>
                                    <p><a href="mailto:sales@pricedrummer.com">sales@pricedrummer.com</a></p>
                                    <h3>Press Room</h3>
                                    <p><a href="mailto:press@pricedrummer.com">press@pricedrummer.com</a></p>
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