<div class="sidebar" style="background-color: #FFFFFF;padding: 10px; margin-top: 12px;border-top: 2px solid #104e84;">
    <ul>
        <h4>About PriceDrummer</h4>
        <li><a href="<?php echo e(url('/about')); ?>">About Us</a></li>
        <li><a href="/careers">Careers</a></li>
        <li><a href="/all_categories">Categories A-Z</a></li>
        <li><a href="/press">Press</a></li>
        <li><a href="/contact">Contact</a></li>
    </ul>

    <ul>
        <h4 style="margin-top: 25px;">Support</h4>
        <li><a href="/guides">How to use PriceDrummer</a></li>
        <li><a href="/for_retailers">Sell on PriceDrummer</a></li>
        <li><a href="/terms_policy">Terms of Use &amp; Privacy
                Policy</a></li>
        <li><a href="/rules_regulations">Rules &amp;
                Regulations</a></li>
        <li><a href="/faq">FAQ</a></li>
    </ul>

    <ul>
        <h4 style="margin-top: 25px;">Social</h4>
        <?php $__currentLoopData = $social_media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class=footer-list-item">
                <a target=_blank href="<?php echo e($link); ?>"><?php echo e($key); ?></a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>