@extends('layouts.app')

@section('title', 'داشبورد گزارش‌ها')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-2">
            <h1 class="fw-bold mb-0">📊 داشبورد گزارش‌ها</h1>
            <a href="/admin" class="btn btn-outline-secondary">
                ⬅ بازگشت به پنل
            </a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

            <div class="col">
                <a href="/admin/reports/orders" class="card h-100 text-decoration-none hover-shadow">
                    <div class="card-body text-center py-4">
                        @if(empty($orders) || count($orders) === 0)
                            <div class="alert alert-info py-3 mb-0">هیچ سفارشی یافت نشد</div>
                        @else
                            <h5 class="card-title text-primary mb-3">📦 سفارش‌ها</h5>
                            <p class="text-muted">مشاهده گزارش کامل سفارشات</p>
                            <span class="badge bg-primary">{{ count($orders) }} سفارش</span>
                        @endif
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="/admin/reports/payments" class="card h-100 text-decoration-none hover-shadow">
                    <div class="card-body text-center py-4">
                        <h5 class="card-title text-success mb-3">💳 پرداخت‌ها</h5>
                        <p class="text-muted">گزارش تراکنش‌های مالی</p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="/admin/reports/surveys" class="card h-100 text-decoration-none hover-shadow">
                    <div class="card-body text-center py-4">
                        <h5 class="card-title text-warning mb-3">⭐ نظرسنجی‌ها</h5>
                        <p class="text-muted">نتایج نظرسنجی غذاها</p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="/admin/reports/users" class="card h-100 text-decoration-none hover-shadow">
                    <div class="card-body text-center py-4">
                        <h5 class="card-title text-dark mb-3">👤 کاربران</h5>
                        <p class="text-muted">لیست کاربران سیستم</p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('admin.reports.popular') }}" class="card h-100 text-decoration-none hover-shadow">
                    <div class="card-body text-center py-4">
                        <h5 class="card-title text-danger mb-3">🍽 غذاهای محبوب</h5>
                        <p class="text-muted">پربازدیدترین و پرامتیازترین غذاها</p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('admin.reports.comments') }}" class="card h-100 text-decoration-none hover-shadow">
                    <div class="card-body text-center py-4">
                        <h5 class="card-title text-info mb-3">💬 دیدگاه‌ها</h5>
                        <p class="text-muted">همه نظرات کاربران درباره غذاها</p>
                    </div>
                </a>
            </div>


        </div>
    </div>

    <style>
        .hover-shadow {
            transition: all 0.25s ease;
        }
        .hover-shadow:hover {
            box-shadow: 0 0.75rem 1.25rem rgba(0, 0, 0, 0.15);
            transform: translateY(-4px);
        }
        .card {
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.08);
        }
    </style>
@endsection
