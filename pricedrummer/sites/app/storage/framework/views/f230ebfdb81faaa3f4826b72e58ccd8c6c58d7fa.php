<?php $__env->startSection('title'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('pages.admin.shared.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Invoices</h1>
                <table id="invoices_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <td>Time</td>
                        <td>IP Address</td>
                        <td>Product</td>
                        <td>URL</td>
                        <td>Type</td>
                        <td>Cost</td>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $total = 0; ?>
                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($invoice->posted_timestamp); ?></td>
                            <td><?php echo e($invoice->user_ip); ?></td>
                            <td><a target="_blank" href="<?php echo e($invoice->compare_url); ?>"><?php echo e($invoice->product_name); ?></a></td>
                            <td><?php echo e($invoice->item_clicked); ?></td>
                            <?php if( $invoice->invoice_type == "ITEM_CLICKED" ): ?>
                                <td>Cost per click</td>
                            <?php elseif( $invoice->invoice_type == "BUDGET_SET" ): ?>
                                <td>Budget set</td>
                            <?php endif; ?>
                            <td><?php echo e(str_replace('-', '', $invoice->amount)); ?></td>
                        </tr>
                        <?php $total = $total + str_replace( '-', '', $invoice->amount ); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if( count( $invoices ) > 0 ): ?>
                        <tr style="opacity: 0">
                            <td><strong>Total</strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php echo e($country_currency); ?><?php echo e(sprintf('%.2f', $total)); ?></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                    <?php if( count( $invoices ) > 0 ): ?>
                        <tfoot>
                        <td><strong>Total</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo e($country_currency); ?><?php echo e(sprintf('%.2f', $total)); ?></td>
                        </tfoot>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(function () {
            $('#invoices_list').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>