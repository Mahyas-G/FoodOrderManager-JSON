<?php $__env->startSection('title', 'گزارش سفارشات'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">📦 گزارش سفارشات</h2>
            <a href="/admin/reports" class="btn btn-outline-secondary">بازگشت</a>
        </div>

        <?php if(empty($orders) || count($orders) === 0): ?>
            <div class="alert alert-info text-center">هیچ سفارشی ثبت نشده است.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-warning">
                    <tr>
                        <th>کد سفارش</th>
                        <th>کاربر</th>
                        <th>مجموع قیمت</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($order['id'] ?? '---'); ?></td>
                            <td><?php echo e($order['user_email'] ?? '---'); ?></td>
                            <td><?php echo e(isset($order['total']) ? number_format($order['total']) . ' تومان' : '---'); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e(($order['status'] ?? '') === 'completed' ? 'success' : 'secondary'); ?>">
                                    <?php echo e($order['status'] ?? '---'); ?>

                                </span>
                            </td>
                            <td>
                                <?php if(!empty($order['created_at'])): ?>
                                    <?php echo e(\Carbon\Carbon::parse($order['created_at'])->format('Y-m-d H:i')); ?>

                                <?php else: ?>
                                    ---
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Programming\Laravel\FoodProject\resources\views/admin/reports/orders.blade.php ENDPATH**/ ?>