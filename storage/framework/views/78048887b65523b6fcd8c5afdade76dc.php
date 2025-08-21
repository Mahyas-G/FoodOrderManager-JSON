<?php $__env->startSection('title', 'رستوران'); ?>

<?php $__env->startSection('content'); ?>
    <div class="welcome-text">
        <h2 class="mb-3">سیستم سفارش آنلاین غذا</h2>
        <p>در قسمت بالای صفحه می‌توانید منو را بررسی کرده تا سفارش خود را ثبت کنید و یا وارد حساب کاربری خود شوید.</p>
    </div>

    <div class="gallery">
        <?php $__currentLoopData = range(1,12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="gallery-item">
                <img src="<?php echo e(asset("images/food$i.jpg")); ?>" class="gallery-img" alt="غذای رستوران">
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Programming\Laravel\FoodProject\resources\views/welcome.blade.php ENDPATH**/ ?>