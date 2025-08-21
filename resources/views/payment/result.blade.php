@extends('layouts.app')

@section('title', 'نتیجه پرداخت')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm border-0" style="max-width: 600px; margin: 0 auto;">
            <div class="card-header bg-{{ $status === 'success' ? 'success' : 'danger' }} text-white">
                <h4 class="mb-0">نتیجه پرداخت</h4>
            </div>

            <div class="card-body text-center py-4">
                @if($status === 'success')
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                        <h3 class="text-success mt-3">پرداخت موفق</h3>
                    </div>
                    <p class="fs-5">پرداخت شما با موفقیت انجام شد.</p>
                @else
                    <div class="mb-4">
                        <i class="bi bi-x-circle-fill text-danger" style="font-size: 3rem;"></i>
                        <h3 class="text-danger mt-3">پرداخت ناموفق</h3>
                    </div>
                    <p class="fs-5">متأسفانه پرداخت شما انجام نشد.</p>
                @endif

                <div class="alert alert-secondary mt-4">
                    <p class="mb-0">کد پیگیری سفارش: <strong>{{ $order_id }}</strong></p>
                </div>

                <div class="mt-5">
                    <a href="/menu" class="btn btn-{{ $status === 'success' ? 'success' : 'danger' }} px-4">
                        بازگشت به منو
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 10px;
        }
    </style>
@endsection
