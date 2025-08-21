@extends('layouts.app')

@section('title', 'داشبورد ادمین')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">🛠 خوش آمدید {{ $user->name ?? '' }}</h2>
        <p class="mb-4">از دکمه‌های زیر برای دسترسی سریع استفاده کنید:</p>

        <div class="row g-3">
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('admin.reports') }}" class="btn btn-outline-primary w-100 py-3">
                    📊 گزارشات کلی
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('menu.create') }}" class="btn btn-outline-success w-100 py-3">
                    ➕ افزودن غذای جدید
                </a>
            </div>
        </div>
    </div>
@endsection
