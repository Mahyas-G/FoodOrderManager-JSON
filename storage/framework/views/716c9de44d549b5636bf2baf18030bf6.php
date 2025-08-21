<?php $__env->startSection('title', 'داشبورد ادمین'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <h2 class="mb-4">🛠 خوش آمدید <?php echo e($user->name ?? ''); ?></h2>
        <p class="mb-4">از دکمه‌های زیر برای دسترسی سریع استفاده کنید:</p>

        <div class="row g-3">
            <div class="col-12 col-md-6 col-lg-3">
                <a href="<?php echo e(route('admin.reports')); ?>" class="btn btn-outline-primary w-100 py-3">
                    📊 گزارشات کلی
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="<?php echo e(route('menu.create')); ?>" class="btn btn-outline-success w-100 py-3">
                    ➕ افزودن غذای جدید
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Programming\Laravel\FoodProject\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>