<?php $__env->startSection('title'); ?> Press - PriceDrummer <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="keywords" content="Press PriceDrummer">
    <meta name="description" content="Press PriceDrummer">
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
                                <h1 style="font-size: 1.5em; margin-top: 5px; margin-bottom: 0px;">Press</h1>
                            </div> <!-- end panel heading div -->
                            <div class="panel-body" style="height: 575px;">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <p>
                                            PriceDrummer is a shopping comparison site that help shoppers to save money.
                                            Shoppers
                                            can compare prices of products and services before they make a purchase. Smart
                                            Shopping
                                            Anytime!</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div ng-if="COUNTRY == 'Ghana'"
                                         class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.094862248633!2d-0.1881810849277275!3d5.552954135223458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdf907d1262400b%3A0x2ba097b5c1029fec!2sLokko+Rd%2C+Accra!5e0!3m2!1sen!2sgh!4v1474362572216"
                                                width="350" height="250" frameborder="0" style="border:0"
                                                allowfullscreen></iframe>
                                    </div>
                                    <div ng-if="COUNTRY == 'Ghana'"
                                         class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                        <h4>Media Contacts</h4>
                                        <address>
                                            <strong>Office Address</strong> <br>
                                            No 3 Lokko Road, Osu <br>
                                            Accra, Ghana <br>
                                            Email: <a style="color: #104e84;border-bottom: thin dotted;" href="mailto:press@pricedrummer.com.gh">press@pricedrummer.com.gh</a>
                                            <br>
                                            Telephone: <a href="tel:+233 (0) 553 600 662">+233 (0) 553 600 662</a>
                                        </address>
                                        PriceDrummer In The News
                                    </div>
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