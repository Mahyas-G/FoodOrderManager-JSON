@extends('layouts.app')

@section('title', 'ثبت سفارش')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">🛒 ثبت سفارش برای <span class="text-warning">{{ $food['name'] }}</span></h2>

        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body">
                <form action="{{ route('orders.store', $food['id']) }}" method="POST" id="orderForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">قیمت هر واحد</label>
                        <input type="text" class="form-control" value="{{ number_format($food['price']) }} هزار تومان" disabled>
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
                               value="{{ number_format($food['price']) }} هزار تومان" disabled>
                        <input type="hidden" name="total_price" id="total_price" value="{{ $food['price'] }}">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success flex-fill">✅ ثبت سفارش</button>
                        <a href="{{ route('menu.index') }}" class="btn btn-outline-secondary flex-fill">↩ بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const quantityInput = document.getElementById('quantity');
        const totalPriceDisplay = document.getElementById('total_price_display');
        const totalPriceHidden = document.getElementById('total_price');
        const pricePerUnit = {{ $food['price'] }};

        function updateTotal() {
            const qty = parseInt(quantityInput.value) || 1;
            const total = pricePerUnit * qty;
            totalPriceDisplay.value = total.toLocaleString('fa-IR') + 'هزار تومان';
            totalPriceHidden.value = total;
        }

        quantityInput.addEventListener('input', updateTotal);
    </script>
@endsection
