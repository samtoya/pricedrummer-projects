<?php $__env->startSection('title'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('pages.admin.shared.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="container">

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-offset-3">
                <h2>Choose...</h2>
                <?php if(isset($Customer_details)): ?>
                    <form method="post" action="<?php echo e(route('collect_invoice')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" name="<?php echo e($customer_type); ?>">
                                        <option selected disabled>Please Choose a Merchant Or Retailer</option>
                                        <?php if(count($Customer_details)>0): ?>
                                            <option value="all">View All</option>
                                        <?php endif; ?>
                                        <?php $__currentLoopData = $Customer_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <option value="<?php echo e($value['id']); ?>"><?php echo e($value['name']); ?></option>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-daterange">
                                        <input type="text" name="date_from" value="<?php echo date('Y-m-d');?>" class="form-control date-picker">
                                        <div class="input-group-addon">to</div>
                                        <input type="text" name="date_to" value="<?php echo date('Y-m-d');?>" class="form-control date-picker">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group pull-right">
                                    <input type="submit" class="btn btn-primary" value="View Invoices">
                                </div>
                            </div>
                        </div>
                    </form>
                <?php else: ?>

                    <form method="post" action="<?php echo e(route('collect_invoice_both')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-daterange">
                                        <input type="text" name="date_from" value="<?php echo date('Y-m-d');?>" class="form-control date-picker">
                                        <div class="input-group-addon">to</div>
                                        <input type="text" name="date_to" value="<?php echo date('Y-m-d');?>" class="form-control date-picker">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group pull-right">
                                    <input type="submit" class="btn btn-primary" value="View Invoices">
                                </div>
                            </div>
                        </div>
                    </form>

                <?php endif; ?>

            </div>


        </div>

    </div> <!-- /container -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(function () {
            $(".input-daterange").datepicker({
                format: 'yyyy-mm-dd',
                endDate: '0d'
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>