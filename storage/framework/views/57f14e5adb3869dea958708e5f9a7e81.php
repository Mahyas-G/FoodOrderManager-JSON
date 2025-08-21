<?php $__env->startSection('title', 'ثبت امتیاز درباره غذا'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="card shadow-sm border-0" style="max-width: 600px; margin: 0 auto;">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">ثبت امتیاز درباره: <?php echo e($food['name'] ?? 'غذا'); ?></h4>
            </div>

            <div class="card-body">
                <form method="POST" action="<?php echo e(route('survey.store', ['food_id' => $food['id']])); ?>" class="rtl-form">
                    <?php echo csrf_field(); ?>

                    <div class="mb-4">
                        <label for="rating" class="form-label">امتیاز شما (از 1 تا 5)</label>
                        <select class="form-select" name="rating" id="rating" required>
                            <option value="" selected disabled>لطفاً امتیاز خود را انتخاب کنید</option>
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <option value="<?php echo e($i); ?>">
                                    <?php for($j = 1; $j <= $i; $j++): ?>
                                        ⭐
                                    <?php endfor; ?>
                                    (<?php echo e($i); ?>)
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-info text-white px-4">ثبت امتیاز</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .rtl-form { direction: rtl; text-align: right; }
        .card { border-radius: 10px; }
        .form-select {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            padding: 0.5rem 1rem;
        }
        .form-select:focus {
            border-color: #17a2b8;
            box-shadow: 0 0 0 0.25rem rgba(23, 162, 184, 0.25);
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Programming\Laravel\FoodProject\resources\views/survey/create.blade.php ENDPATH**/ ?>