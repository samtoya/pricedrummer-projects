<?php $__env->startSection('content'); ?>
    <div class="container" style="margin-top: 20px;">
        <div class="message_container">
            <h2>Thanks for visiting PriceDrummer</h2>
            <p class="link">You're on your way to </p>
            <a href="#"><img id="merchant_logo" width="100px" src="http://www.pricedrummer.com/images/static/merchants/ghana/<?php echo e($product->merchant_id); ?>.jpg" alt=""></a>
            <img id="preloader" src="../img/preloader.gif" alt="">
            <p>We hope to see you again</p>
            <img id="site_logo" src="../img/site-logo/pxdm_logo.png" alt="">
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        // Redirect the user to the selected product site after 5 seconds
        window.setTimeout(function () {
            // Goto the product site
            window.location.href = "<?php echo e($product->url); ?>";
        }, 5000);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.goodbye', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>