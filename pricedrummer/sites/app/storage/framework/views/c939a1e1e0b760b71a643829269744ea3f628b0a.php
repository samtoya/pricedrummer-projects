<br> 
Hello Seller
<hr>
Email: <?php echo e($user_info['email']); ?>

<br>
<?php if( ! empty( $user_info['telephone_number'] ) ): ?>
	Phone: <?php echo e($user_info['telephone_number']); ?>

<?php endif; ?>
<hr>
<br>
Message: <br> <?php echo e($user_info['message']); ?>