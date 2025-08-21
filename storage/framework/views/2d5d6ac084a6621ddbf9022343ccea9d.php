<?php $__env->startSection('title', 'ثبت سفارش'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <h2 class="mb-4">🛒 ثبت سفارش برای <span class="text-warning"><?php echo e($food['name']); ?></span></h2>

        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body">
                <form action="<?php echo e(route('orders.store', $food['id'])); ?>" method="POST" id="orderForm">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label class="form-label fw-bold">قیمت هر واحد</label>
                        <input type="text" class="form-control" value="<?php echo e(number_format($food['price'])); ?> هزار تومان" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label fw-bold">تعداد</label>
                        <input type="number" name="quantity" id="quantity" class="form-control"
                               value="1" min="1" max="10" required>
                    </div>

                    <div class="mb-3">
                        <label for="discount_code" class="form-label fw-bold">کد تخفیف (اختیاری)</label>
                        <input type="text" name="discount_code" id="discount_code" class="form-control"
                               placeholder="">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">مبلغ نهایی</label>
                        <input type="text" id="total_price_display" class="form-control bg-light"
                               value="<?php echo e(number_format($food['price'])); ?> هزار تومان" disabled>
                        <input type="hidden" name="total_price" id="total_price" value="<?php echo e($food['price']); ?>">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success flex-fill">✅ ثبت سفارش</button>
                        <a href="<?php echo e(route('menu.index')); ?>" class="btn btn-outline-secondary flex-fill">↩ بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const quantityInput = document.getElementById('quantity');
        const totalPriceDisplay = document.getElementById('total_price_display');
        const totalPriceHidden = document.getElementById('total_price');
        const pricePerUnit = <?php echo e($food['price']); ?>;

        function updateTotal() {
            const qty = parseInt(quantityInput.value) || 1;
            const total = pricePerUnit * qty;
            totalPriceDisplay.value = total.toLocaleString('fa-IR') + 'هزار تومان';
            totalPriceHidden.value = total;
        }

        quantityInput.addEventListener('input', updateTotal);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Programming\Laravel\FoodProject\resources\views/orders/create.blade.php ENDPATH**/ ?>