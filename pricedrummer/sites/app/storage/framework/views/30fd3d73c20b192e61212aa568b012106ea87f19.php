

<?php $__env->startSection('title'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?> 
    <section class="container">
    <section class="row">
        <div class="col-xs-12 col-sm-6 col-lg-12 col-md-12" id="no-search">
            <h4>0 results for search "<span style="color: #FF5500;"><?php echo e($search_param); ?></span>".</h4>
        </div>

        <div class="col-md-6 col-xs-12 col-sm-6 col-lg-6 col-md-offset-3 col-lg-offset-3" id="search-tips">
            <h4>Search Tips</h4>
            <ul>
                <li>Check your spelling for typing errors</li>
                <li>Try using general search terms (i.e "LG TV" instead of "LG 42LF551V 42 Inches")</li>
                <li>Use a different keyword or a more common term (i.e "Mobile phones", "Cars", "Laptops", "TVs")
                </li>
            </ul>
        </div>
    </section>

    <div>
        <div class="panel-widget-wrapper clearfix" style="margin-bottom: 15px;">
            <div class="panel-widget">
                <div class="panel-widget-heading">
                    <h2 class="panel-title">Please Checkout These Popular Categories...</h2>
                </div>
                <div class="panel-widget-body">
                     <?php $__currentLoopData = $home_quick_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 col-lg-4 col-sm-6 no-padding panel-widget-thumbs">
                            <h5><?php echo e($category->name); ?></h5>
                            <div class="col-md-4 col-sm-3 no-padding"><img alt="<?php echo e($category->name); ?>'s image"
                                                                           src="/img/60x60/<?php echo e($category->image); ?>"
                                                                           title="<?php echo e($category->name); ?>">
                            </div>
                            <div class="col-md-8 col-sm-9 no-padding">
                                <ul class="panel-widget-categories">
                                    <?php $__currentLoopData = $category->sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e($sub_category->url); ?>">
                                                <?php echo e($sub_category->shortname); ?><?php echo e($loop->last ? "" : ","); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>