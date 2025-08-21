<?php $__env->startSection('title', 'گزارش پرداخت‌ها'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">💳 گزارش پرداخت‌ها</h2>
            <a href="/admin/reports" class="btn btn-outline-secondary">بازگشت</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-success">
                <tr>
                    <th>کد تراکنش</th>
                    <th>مبلغ</th>
                    <th>وضعیت</th>
                    <th>تاریخ</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($payment['id']); ?></td>
                        <td><?php echo e(number_format($payment['amount'])); ?> تومان</td>
                        <td>
                                <span class="badge bg-<?php echo e($payment['status'] == 'success' ? 'success' : 'danger'); ?>">
                                    <?php echo e($payment['status']); ?>

                                </span>
                        </td>
                        <td><?php echo e(jdate($payment['created_at'])->format('Y/m/d H:i')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Programming\Laravel\FoodProject\resources\views/admin/reports/payments.blade.php ENDPATH**/ ?>