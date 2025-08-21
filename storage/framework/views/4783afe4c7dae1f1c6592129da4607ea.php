<?php $__env->startSection('title', 'گزارش دیدگاه‌ها'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">💬 گزارش دیدگاه‌ها</h2>
            <a href="<?php echo e(route('admin.reports')); ?>" class="btn btn-outline-secondary">بازگشت</a>
        </div>

        <?php if(empty($comments) || count($comments) === 0): ?>
            <div class="alert alert-info text-center">هیچ دیدگاهی ثبت نشده است.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-warning">
                    <tr>
                        <th>غذا</th>
                        <th>کاربر</th>
                        <th>متن دیدگاه</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($comment['food_name'] ?? '---'); ?></td>
                            <td><?php echo e($comment['user_email'] ?? '---'); ?></td>
                            <td><?php echo e($comment['text'] ?? '---'); ?></td>
                            <td>
                                <?php if(!empty($comment['created_at'])): ?>
                                    <?php echo e(\Carbon\Carbon::parse($comment['created_at'])->format('Y-m-d H:i')); ?>

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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Programming\Laravel\FoodProject\resources\views/admin/reports/comments.blade.php ENDPATH**/ ?>