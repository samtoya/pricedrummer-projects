<?php $__env->startSection('title'); ?> Compare <?php echo e($category->name); ?> Prices - PriceDrummer <?php echo e($country_name); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="keywords"
          content="<?php echo e($category->name); ?>, Compare <?php echo e($category->name); ?> prices, Cheap <?php echo e($category->name); ?> products online, reviews on <?php echo e($category->name); ?> products, expert <?php echo e($category->name); ?> reviews,  discount <?php echo e($category->name); ?>, cheapest <?php echo e($category->name); ?> products online, PriceDrummer <?php echo e($country_name); ?>"/>
    <meta name="description"
          content="<?php echo e($category->name); ?>. Compare <?php echo e($country_name); ?> prices for <?php echo e($category->name); ?> brands, read product reviews and use our easy price comparison to help you find the best value online at PriceDrummer"/>
    <meta property="og:title" content="<?php echo e($category->name); ?> – Best deals on PriceDrummer <?php echo e($country_name); ?>"/>
    <meta property="og:description"
          content="Find the cheapest prices on <?php echo e($category->name); ?> on PriceDrummer <?php echo e($country_name); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-12 col-sm-12 hidden-xs col-lg-12" style="margin-top: -10px;">
                <div class="breadcrumb">
                    <div class="bread-crumb">
                        <ul>
                            <li class="bc-home"><a href="<?php echo e(url('/')); ?>">PriceDrummer</a></li>
                            <li class="bc-home breadcrumb-last"><?php echo e($category->name); ?></li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="visible-xs col-xs-12" style="margin-top: -10px;">
                <div class="breadcrumb">
                    <div class="bread-crumb">
                        <ul>
                            <li class="bc-home"><a href="<?php echo e(url('/')); ?>">PriceDrummer</a></li>
                            <li class="bc-home"><?php echo e($category->name); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- end row div -->

        <div class="row">
            <div class="col-md-10 col-xs-12 col-lg-10" style="margin-top: -10px;">
                <div class="row product_page">
                    <div style="">
						<?php $classNum = 1; ?>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category_l2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="<?php
							echo "class" . $classNum;
							$classNum ++;
							if ( $classNum > 3 ) {
								$classNum = 1;
							}
							?>">
                                <p class="head_proname"><?php echo e($category_l2->name); ?></p>
                                <div class="thumbnail single-list-product test-category" style="width: 100%;">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="image_wrapper">
                                                <img src="/img/cat_images/<?php echo e(ReformatID( $category_l2->name )); ?>.png"
                                                     alt="asqwsada" title="">
                                            </div>

                                        </div>
                                        <div style="margin-top: 10px;_max-height: 105px;overflow: hidden;transition: all 2s ease;"
                                             id="category_lev_3_list" class="row">
                                            <div class="list_info">
                                                <ul>
                                                    <?php $__currentLoopData = $category_l2->lev3s; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category_l3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li>
                                                            <a style="font-size: 12px;"
                                                               class="<?php if ( count( $category_l3->lev4s ) > 0 ) {
																   echo 'disabled';
															   } else {
																   echo '';
															   } ?>"
															   <?php
															   if ( count( $category_l3->lev4s ) > 0 ) {
																   echo '';
															   } else {
																   echo 'href="/filter/' . $category_l3->category_id . '/' . spacelessUrl( lowercase( $category_l3->name ) ) . '"';
															   } ?>
                                                               title="">
                                                                <?php echo e($category_l3->name); ?>

                                                            </a>
                                                            <?php $__currentLoopData = $category_l3->lev4s; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category_l4): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="level-4sub"
                                                                     style="margin-left: 17px; font-size: 11px;">
                                                                    <a style="font-size: 12px;"
                                                                       href="/filter/<?php echo e($category_l4->category_id); ?>/<?php echo e(spacelessUrl(lowercase($category_l4->name))); ?>"
                                                                       title=""><?php echo e($category_l4->name); ?></a>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <button class="show_all">Show all...</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>


                    <div class="row" style="margin-top: -10px;">
                        <div class="col-md-12 col-lg-12">
                            <div class="col-md-4 col-sm-6 col-xs-12" id="MyClass1">
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12" id="MyClass2">
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12" id="MyClass3">
                            </div>
                        </div>
                    </div>


                </div>
            </div> <!-- end col-md-10 div -->

            <div class="col-md-2" style="margin-left: -5px; margin-top: -10px;">
                <!--<div class="handle_abs">-->
                <!--<div class="category_area" style="height: 736px; padding: 5px;">-->
                <!--<p>Content of advert goes here.</p>-->
                <!--</div>-->
                <!--</div> -->
            </div><!-- end col-md-2 div -->
        </div> <!-- end row div -->
    </div>

	<?php
	echo "<script>
            $('#MyClass1').html($('.class1'));
            $('#MyClass2').html($('.class2'));
            $('#MyClass3').html($('.class3'));
         </script>";
	?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>