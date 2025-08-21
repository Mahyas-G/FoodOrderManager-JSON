<?php $__env->startSection('title', 'ورود به حساب کاربری'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="card shadow-sm border-0" style="max-width: 500px; margin: 0 auto;">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">ورود به حساب کاربری</h4>
            </div>

            <div class="card-body">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div><?php echo e($error); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="/login" class="rtl-form">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">ایمیل</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="ایمیل خود را وارد کنید" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">رمز عبور</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="رمز عبور خود را وارد کنید" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">ورود</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p>حساب کاربری ندارید؟ <a href="/register" class="text-success">ثبت‌نام کنید</a></p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Programming\Laravel\FoodProject\resources\views/auth/login.blade.php ENDPATH**/ ?>