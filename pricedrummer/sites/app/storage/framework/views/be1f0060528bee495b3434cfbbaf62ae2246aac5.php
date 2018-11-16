<?php $__env->startSection('title'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container" style="margin-top: 20px;">
        <div id="member-area" class="col-md-12 col-lg-12 col-sm-12 col-xs-12 clearfix">
            <div id="member-content" class="col-lg-11 col-mg-11 col-sm-11 col-xs-11">
                <div id="main-area">
                    <div id="member-info" class="col-xs-12 col-md-9 col-sm-9 col-lg-9 clearfix">
                        <div id="member-logo" class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                            <img src="http://www.pricedrummer.com/images/static/retailers/ghana/<?php echo e($retailer_info->merchant_id); ?>.jpg" alt="<?php echo e($retailer_info->company_name); ?>" title="<?php echo e($retailer_info->company_name); ?>">
                        </div>

                        <div id="member-company" class="col-lg-7 col-md-7 col-md-7 col-xs-12">
                            <h1 id="company_name" data-id="retailer-<?php echo e($retailer_info->merchant_id); ?>" data-name="<?php echo e($retailer_info->company_name); ?>"><?php echo e(ucwords( $retailer_info->company_name )); ?></h1>
                            <ul>
                                <?php if( ! empty( $retailer_info->email ) ): ?>
                                    <li>
                                        <i class="fa fa-envelope"></i> 
                                        <a target="_blank" title="Contact us via email" href="mailto:<?php echo e($retailer_info->email); ?>">
                                            <?php echo e($retailer_info->email); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if( ! empty( $retailer_info->site_url ) ): ?>
                                    <li>
                                        <i class="fa fa-globe"></i> 
                                        <a title="<?php echo e($retailer_info->site_url); ?>'s website" href="<?php echo e($retailer_info->site_url); ?>">
                                            <?php echo e($retailer_info->site_url); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if( ! empty( $retailer_info->shop_address ) ): ?>
                                    <li>
                                        <i class="fa fa-location-arrow"></i>
                                        <span>
                                            <?php echo e($retailer_info->shop_address); ?>

                                        </span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <div id="member-details" class="clearfix">
                        <div id="contact-member" class="pull-right">
                            <button id="contact_info" onclick="getNumberDetail(this)">
                                <?php echo e($dummy_phone); ?>

                            </button>

                            <div id="member_number">

                            </div>
                        </div>
                    </div>
                </div>
              </div>
        </div>
    </div>

     <div class="container">
         <div id="ad-header" class="clearfix">
            <p>All ads from <?php echo e(ucwords( $retailer_info->company_name )); ?> </p>
            <hr style="width: 10%;  border-color: #11508C;">
        </div>

        <div id="member-products" class="col-md-12 col-xs-12 col-md-12 col-sm-12">
            <?php if( ! empty( $retailer_products ) ): ?>
                <?php $__currentLoopData = $retailer_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                        <div id="member-product" class="col-md-6 col-lg-6 col-sm-6 clearfix">
                            <div id="member-product-image" class="col-md-2 col-sm-2 col-lg-2 col-lg-2">
                                <img src="//placehold.it/400x400" alt="">
                            </div>

                            <div id="member-product-info" class="col-xs-6 col-md-6 col-lg-6 col-sm-6">
                                <h3 class="product-name"><?php echo e($product->manufacturer); ?> <?php echo e($product->model_nuber); ?></h3>
                            </div>

                            <div id="member-actions" class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
                                <div class="actions_aling">
                                    <span class="pri_range">GH¢<?php echo e($product->price); ?></span>
                                    <br>
                                    <a href="#" class="store">Contact Seller</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>

            <?php endif; ?>            
                
                
        </div>
     </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        function getNumberDetail(referrence) {
            var retailer_name = $("#company_name").data('name');
            var member_number = $('#member_number');
            var $this = $(referrence[0]);
            var elements = [];
            var telephone = [];
            var completed = false;

            if ( completed === false ) { 
                $.ajax({
                    method: 'GET',
                    url: '/api/v1/retailers/?name=' + retailer_name,
                    success: function( response ) {
                        data = response.data[0];
                        // console.log( response.data[0] );
                        if ( data !== null  ) {
                            telephone.push( data.telephone1 );
                            if ( data.telephone2 !== null ) { 
                                telephone.push( data.telephone2 );
                            }
                        }

                        // Loop through the telephone array
                        for ( var i = 0; i <= telephone.length; i++ ) {
                            // Insert a new element in the DOM.
                            elements.push( $('<span>').text(telephone[i]) );
                            console.log( elements ); 
                        }
                        // Insert it in the DOM.
                        
                        // console.log( telephone.length );
                    },
                    error: function(error) {
                        console.log( error );
                    }
                });
            }
            
            completed = true;
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>