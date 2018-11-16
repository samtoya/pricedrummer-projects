<ul class="pagination clearfix pull-right">
    <?php if($compare_products_data->current_page !=1): ?>
        <li class="page-item first">
            <a href="<?php echo e($compare_products_data->first_page_url); ?>" class="page-link">
                First
            </a>
        </li>
        <li class="page-item prev ">
            <a href="
                
            <?php if(empty($compare_products_data->prev_page_url)): ?>
            <?php echo e('#'); ?>

            <?php else: ?>
            <?php echo e($compare_products_data->prev_page_url); ?>

            <?php endif; ?>
                    "
               class="page-link">
                Previous
            </a>
        </li>
    <?php endif; ?>
    <li class="page-item active">
        <a class="page-link disabled">
            Page <?php echo e($compare_products_data->current_page); ?> of <?php echo e($compare_products_data->last_page); ?>

        </a>
    </li>
    
    <?php if($compare_products_data->current_page != $compare_products_data->last_page): ?>
        <li class="page-item next">
            
            <a href="
                        <?php if(empty($compare_products_data->next_page_url)): ?>
            <?php echo e('#'); ?>

            <?php else: ?>
            <?php echo e($compare_products_data->next_page_url); ?>

            <?php endif; ?>
                    "
               class="page-link
                        <?php if(empty($compare_products_data->next_page_url)): ?>
               <?php echo e('disabled'); ?>

               <?php endif; ?>">
                Next
            </a>
        </li>
        <li class="page-item last"><a href="<?php echo e($compare_products_data->last_page_url); ?>" class="page-link">Last</a>
        </li>
    <?php endif; ?>
</ul>