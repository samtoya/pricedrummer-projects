<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-2 rm-pad col-lg-2">
                <div class="handle_category">
                    <div><?php echo $__env->make('pages.static.shared.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
                </div> <!-- end handle category div -->
            </div> <!-- end col-*-2 div -->

            <div class="col-md-8 col-lg-8" style="margin-top: 10px;">
                <div class="tab-content">
                    <div id="contact" class="tab-pane active fade in">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h1>Sell on PriceDrummer</h1>
                            </div> <!-- end panel heading div -->
                            <div class="panel-body" style="height: 575px;">
                                <img src="img/how_to_sell.jpg" alt="how_to_sell image" title="How to sell on PriceDrummer">
                            </div> <!-- end panel body div -->
                        </div> <!-- end panel div -->
                    </div> <!-- end contact div -->
                </div> <!-- end tab content div -->
            </div> <!-- end col-*-8 div -->

        </div> <!-- end row div -->
    </div> <!-- end container div -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>