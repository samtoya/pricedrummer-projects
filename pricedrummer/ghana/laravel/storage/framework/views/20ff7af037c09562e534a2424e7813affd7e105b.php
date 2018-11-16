<?php $__env->startSection('title'); ?> Contact Seller <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if( count( $errors ) > 0 ): ?>
        <div id="feedback" class="fail">
            <h3>Oops!</h3>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($error); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <a class="dismiss">Dismiss</a>
        </div>
    <?php endif; ?>

    <?php if( ! empty( $success ) ): ?>
        <div class="alert alert-success">
            <?php echo e($success); ?>

        </div>
    <?php endif; ?>

    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="seller_heading col-md-12 col-sm-12 hidden-xs col-lg-12" style="margin-top: -10px;">
                <h1>Contact Seller</h1>
            </div>
        </div>

        <div class="row seller_area">
            <div class="col-md-12 col-sm-12 hidden-xs col-lg-12">
                <div class="seller_left col-md-4 col-lg-4">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="main_image_wrapper">
                                <img style="max-height: 200px;"
                                     src="http://www.pricedrummer.com/images/static/product_images/large/<?php echo e($compare_product->image); ?>.png"
                                     alt="">
                            </div>
                        </div>
                        <!--<div class="row">-->
                        <!--<div class="col-md-4 col-lg-4">-->
                        <!--<img src="static/product_images/thumbs/13108.png" alt="">-->
                        <!--</div>-->
                        <!--</div> http://www.pricedrummer.com/images/static/product_images/medium/21541.png -->
                    </div>
                </div>
                <div class="seller_right col-md-8 col-lg-8">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="item_area">
                                <div class="sellerPriceArea">
                                    <div class="seller_btn pull-right">
                                        <a href="#send"><img width="150" height="34"
                                                             src="https://image-priceprice.ssl.k-img.com/ph/images/common/btn_sendmessage_02.png"></a>
                                        
                                    </div>
                                    <p class="seller_name">
                                        <?php echo e($compare_product->name); ?>

                                    </p>
                                    <ul class="seller_price">
                                        <?php if( ! empty( $retailer_product->price ) ): ?>
                                            <li>Price: <span class="price">GH¢<?php echo e(sprintf("%.2f", $retailer_product->price)); ?></span></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <table style="margin-top: 10px; margin-bottom: 20px;" class="specs_table">
                                <tbody>
                                <tr>
                                    <?php if( ! empty($retailer_info->company_name ) ): ?>
                                        <th>Retailer Company Name</th>
                                    <?php endif; ?>
                                    <td>
                                        <?php echo e($retailer_info->company_name); ?>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="specs_table">
                                <tbody>
                                <tr>
                                    <?php if( ! empty( $retailer_info->shop_address ) ): ?>
                                        <th>Physical Shop Address</th>
                                    <?php endif; ?>
                                    <td><?php echo e($retailer_info->shop_address); ?></td>
                                </tr>
                                <tr>
                                    <th>Delivery</th>
                                    <td>
                                        <?php if( $retailer_product->has_delevery == 1 ): ?>
                                            <p>
                                                Delivery Cost: depends on the location.
                                                <br>
                                                Est. Delivery Days: <?php echo e($retailer_product->delevery_details); ?>

                                            </p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="seller_info_area col-md-3 col-lg-3">
                <div class="seller_box">
                    <h2>Seller Info</h2>
                    <div class="seller_info_image">
                        <a href="/member/<?php echo e(spacelessUrl( lowercase( $retailer_info->company_name ) )); ?>"><img alt=""
                                                                                                             height="44"
                                                                                                             src="http://www.pricedrummer.com/images/static/retailers/ghana/<?php echo e($retailer_info->merchant_id); ?>.jpg"></a>
                    </div>

                    <div class="seller_info_name">
                        <a href="/member/<?php echo e(spacelessUrl( lowercase( $retailer_info->company_name ) )); ?>"><?php echo e($retailer_info->company_name); ?></a>
                    </div>

                    <!--<div class="seller_info_list">-->
                    <!--<ul>-->
                    <!--<li>Physical Shop</li>-->
                    <!--<li class="tel">-->
                    <!--<span>Tel</span>-->
                    <!--<img class="telImg"-->
                    <!--onerror="this.src='https://image-priceprice.ssl.k-img.com/ph/images/common/bg_grey_01.gif'; this.onerror=null; return false;"-->
                    <!--src="https://image-priceprice.ssl.k-img.com/ph/images/user/user_shop/39222/tel_ee1d21306cddf0e43641f1dc52d810be.png">-->
                    <!--</li>-->
                    <!--</ul>-->
                    <!--</div>-->
                </div>
            </div>
            <div class="message_area col-md-9 col-lg-9">
                <div class="message_box">
                    <div class="message_title">
                        <h2 id="send">Send Message</h2>
                    </div>

                    <form method="post" action="/contact_seller/<?php echo e($retailer_product->retailer_id); ?>" id="retailer_email_form">

                        <?php echo e(csrf_field()); ?>


                        <div class="message_input_wrapper">
                            <label for="inquiry_email">E-mail</label>
                            <input type="email" id="inquiry_email" name="inquiry_email" value="<?php echo e(old('inquiry_email')); ?>">
                        </div>

                        <div class="message_input_wrapper">
                            <label for="inquiry_number">Phone number <span>(optional)</span></label>
                            <input type="text" id="inquiry_number" name="inquiry_number" value="<?php echo e(old('inquiry_number')); ?>">
                        </div>

                        <div class="message_input_wrapper">
                            <label for="inquiry_message">Message to seller</label>
                            <textarea id="inquiry_message" name="inquiry_message" rows="8" cols="20"><?php echo e(old('inquiry_message')); ?></textarea>
                        </div>

                        <div class="message_input_wrapper">
                            <p>
                                <label>
                                    <input type="checkbox" id="inquiry_copy_flag" name="inquiry_copy_flag" value="1">
                                    <span>&nbsp;send a copy to me</span>
                                </label>
                            </p>
                            <input type="submit" class="seller_submit_btn">
                        </div>

                    </form>


                    <ul class="attention">
                        <li><i class="fa fa-check"></i>&nbsp;If the seller offers a higher price than the price shown,
                            <a href="http://m.me/PriceDrummerGH" target="_blank">please let us know.</a>
                        </li>
                        <li><i class="fa fa-check"></i>&nbsp;Please Never pay in advance to receive the object from the
                            seller.
                        </li>
                        <li><i class="fa fa-check"></i>&nbsp;The seller and purchaser are responsible for this
                            transaction.
                            We make no warranty of the content.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    
        

            
                
            

            
            
            
            
            
            
            

            

            
               
                
                
                

                
                

                
            

        
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>