<?php $__env->startSection('title', 'دیدگاه‌ها درباره ' . ($food['name'] ?? 'غذا')); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <h3>دیدگاه‌ها برای: <?php echo e($food['name'] ?? ''); ?></h3>

        <?php if(empty($comments)): ?>
            <p class="text-muted">هیچ دیدگاهی ثبت نشده است.</p>
        <?php else: ?>
            <ul class="list-group">
                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item">
                        <strong>کاربر <?php echo e($comment['user_id'] ?? 'ناشناس'); ?></strong>
                        <span class="text-muted float-end"><?php echo e($comment['date'] ?? ''); ?></span>
                        <p class="mb-0"><?php echo e($comment['message']); ?></p>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Programming\Laravel\FoodProject\resources\views/comments/list.blade.php ENDPATH**/ ?>