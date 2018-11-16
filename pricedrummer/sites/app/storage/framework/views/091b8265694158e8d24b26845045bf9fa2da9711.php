<div id="grid" class="row tab-pane fade in active">
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" style="margin-left: -15px;">

        <div style="display: none;">
            <div style="text-align: center;"><br/>
                <h1>No Products</h1></div>
        </div>
        <?php $__currentLoopData = $compare_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $compare_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm-6 col-md-4 col-lg-4 col-xs-6">
            <div class="single-product">
                <div class="product-image">
                    <div class="show-img">
                        <a href="<?php echo e($compare_product->url); ?>">
                            <img src="//pricedrummer.com/images/static/product_images/thumbs/<?php echo e($compare_product->image); ?>.png" alt="<?php echo e($compare_product->name); ?>'s image" title="<?php echo e($compare_product->name); ?>"></a>
                    </div> <!-- end show-img div -->
                </div> <!-- end product-image div -->
                <div class="prod-info">
                    <?php if( $compare_product->prices_count == 1 && $compare_product->isMerchantProduct == 1 ): ?>
                        <h2 class="pro-name">
                            <a target="_blank" href="/redirect/<?php echo e($compare_product->product_id); ?>"><?php echo e($compare_product->name); ?></a>
                        </h2>
                    <?php elseif( $compare_product->prices_count == 1 && $compare_product->isRetailerProduct == 1 ): ?>
                        <h2 class="pro-name">
                            <a href="<?php echo e($compare_product->url); ?>"><?php echo e($compare_product->name); ?></a>
                        </h2>
                    <?php elseif( $compare_product->prices_count > 1 && $compare_product->isBothMerchantAndRetailer == 1 || $compare_product->prices_count > 1 && $compare_product->isMerchantProduct == 1 || $compare_product->prices_count > 1 && $compare_product->isRetailerProduct == 1): ?>
                        <h2 class="pro-name">
                            <a href="<?php echo e($compare_product->url); ?>"><?php echo e($compare_product->name); ?></a>
                        </h2>
                    <?php endif; ?>
                    <div class="price-box">
                        <div class="price">
                            <span>
                                <?php echo e($country_currency); ?><?php echo e(sprintf("%.2f", $compare_product->min_price)); ?>

                            </span>
                        </div>
                    </div>
                    <div class="actions">
                        <span class="add-to-cart">
                            <!--If there is only one merchant/retailer then goto store else compare page-->
                            <?php if( $compare_product->prices_count == 1 && $compare_product->isMerchantProduct == 1 ): ?>
                                <a target="_blank" href="/redirect/<?php echo e($compare_product->product_id); ?>?curl=<?php echo e(urlencode($compare_product->compare_url)); ?>">
                                    <span>Go to Store</span>
                                </a>
                            <?php elseif( $compare_product->prices_count == 1 && $compare_product->isRetailerProduct == 1 ): ?>
                                <a href="<?php echo e($compare_product->url); ?>?cpid=<?php echo e($compare_product->id); ?>">
                                    <span>Contact Seller</span>
                                </a>
                            <?php elseif( $compare_product->prices_count > 1 && $compare_product->isBothMerchantAndRetailer == 1 || $compare_product->prices_count > 1 && $compare_product->isMerchantProduct == 1 || $compare_product->prices_count > 1 && $compare_product->isRetailerProduct == 1): ?>
                                <a href="<?php echo e($compare_product->url); ?>">
                                    <span>Compare Prices</span>
                                </a>
                            <?php endif; ?>

                        </span>
                        <div class="ret_ail">
                            <span>
                                 <?php echo e($compare_product->prices_count); ?> <?php echo e(str_plural('price', $compare_product->prices_count)); ?>

                            </span>
                        </div>
                    </div>

                    <div class="rating">
                        <?php for($i=0;$i<=4;$i++): ?>
                            <i class="fa fa-star-o"></i>
                        <?php endfor; ?>
                    </div>
                </div> <!-- end prod-info div -->
            </div> <!-- end single-product div -->
        </div> <!-- end col-sm-4 col-md-3 col-lg-3 col-xs-6 div -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>


</div> <!-- end grid div -->