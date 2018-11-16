<div id="list" class="tab-pane fade in active">
    <div class="product-list">
        <div class="row">
            <div class="col-md-12">
                <?php $__currentLoopData = $compare_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $compare_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <div class="single-list-product" style="height: 100px;">
                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-3">
                        <div class="show-img">
                            <a href="<?php echo e($compare_product->url); ?>">
                                
                                <img src="//pricedrummer.com/images/static/product_images/thumbs/<?php echo e($compare_product->image); ?>.png" alt="<?php echo e($compare_product->name); ?>'s image" title="<?php echo e($compare_product->name); ?>">
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-7 col-md-7 col-lg-7 col-xs-7">
                        <div class="prod-list-detail">
                            <div class="prod-info1">
                                <?php if( $compare_product->prices_count == 1 && $compare_product->isMerchantProduct == 1 ): ?>
                                    <h3 class="pro_name">
                                        <a target="_blank" href="/redirect/<?php echo e($compare_product->product_id); ?>"><?php echo e($compare_product->name); ?></a>
                                    </h3>
                                <?php elseif( $compare_product->prices_count == 1 && $compare_product->isRetailerProduct == 1 ): ?>
                                    <h3 class="pro_name">
                                        <a href="<?php echo e($compare_product->url); ?>"><?php echo e($compare_product->name); ?></a>
                                    </h3>
                                <?php elseif( $compare_product->prices_count > 1 && $compare_product->isBothMerchantAndRetailer == 1 || $compare_product->prices_count > 1 && $compare_product->isMerchantProduct == 1 || $compare_product->prices_count > 1 && $compare_product->isRetailerProduct == 1): ?>
                                    <h3 class="pro_name">
                                        <a href="<?php echo e($compare_product->url); ?>"><?php echo e($compare_product->name); ?></a>
                                    </h3>
                                <?php endif; ?>
                                <div class="hidden-md hidden-lg hidden-sm visible-xs">
                                    <span class="pri_range">
                                        <?php echo e($country_currency); ?><?php echo e(sprintf("%.2f", $compare_product->min_price)); ?>

                                    </span>
                                    <span>
                                        <?php echo e($compare_product->prices_count); ?> <?php echo e(str_plural('price', $compare_product->prices_count)); ?>

                                    </span>
                                </div>
                                <div class="rating">
                                    <?php for($i=0;$i<=4;$i++): ?>
                                        <i class="fa fa-star-o"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-2 hidden-sm hidden-md hidden-lg">
                        <?php if( $compare_product->prices_count == 1 && $compare_product->isMerchantProduct == 1 ): ?>
                            <a class="change_btn_co mobile_button" target="_blank" href="/redirect/<?php echo e($compare_product->product_id); ?>">
                                <span class="btn btn-warning"><i class="fa fa-3x fa-angle-right" aria-hidden="true"></i></span>
                            </a>
                        <?php elseif( $compare_product->prices_count == 1 && $compare_product->isRetailerProduct == 1 ): ?>
                            <a class="change_btn_co mobile_button" href="<?php echo e($compare_product->url); ?>">
                                <span class="btn btn-warning"><i class="fa fa-3x fa-angle-right" aria-hidden="true"></i></span>
                            </a>
                        <?php elseif( $compare_product->prices_count > 1 && $compare_product->isBothMerchantAndRetailer == 1 || $compare_product->prices_count > 1 && $compare_product->isMerchantProduct == 1 || $compare_product->prices_count > 1 && $compare_product->isRetailerProduct == 1): ?>
                            <a class="change_btn_co mobile_button" href="<?php echo e($compare_product->url); ?>">
                                <span class="btn btn-warning"><i class="fa fa-3x fa-angle-right" aria-hidden="true"></i></span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="hidden-xs hidden-sm hidden-lg hidden-md">
                        <a href="<?php echo e($compare_product->url); ?>"><h3> <?php echo e($compare_product->name); ?> </h3>
                        </a>
                        <span class="mf-price">
                            <?php echo e($country_currency); ?><?php echo e($compare_product->min_price); ?>

                        </span>
                        <span>
                                 <?php echo e($compare_product->prices_count); ?> <?php echo e(str_plural('price', $compare_product->prices_count)); ?>

                            </span>
                        <div class="mf-rating">
                            <i class="fa fa-star"></i>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3 col-lg-3 hidden-xs">
                        <div class="actions">
                            <div class="actions_aling">
                                <span class="pri_range">
                                <?php echo e($country_currency); ?><?php echo e(sprintf("%.2f", $compare_product->min_price)); ?>

                                </span>
                                <br>
                                <span class="add-to-cart">
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
                                    
                                    <p>
                                        <?php echo e($compare_product->prices_count); ?> <?php echo e(str_plural('price', $compare_product->prices_count)); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>
    </div>
</div> <!-- end list div -->