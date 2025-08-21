@extends('layouts.app')

@section('title', 'گزارش غذاهای محبوب')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">🍽 گزارش غذاهای محبوب</h2>
            <a href="{{ route('admin.reports') }}" class="btn btn-outline-secondary">بازگشت</a>
        </div>

        @if(empty($foods) || count($foods) === 0)
            <div class="alert alert-info text-center">هیچ غذایی در نظرسنجی‌ها ثبت نشده است.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-danger">
                    <tr>
                        <th>نام غذا</th>
                        <th>قیمت</th>
                        <th>میانگین امتیاز</th>
                        <th>تعداد رأی‌ها</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($foods as $food)
                        <tr>
                            <td class="fw-bold text-danger">{{ $food['name'] ?? '---' }}</td>
                            <td>{{ number_format($food['price'] ?? 0) }} تومان</td>
                            <td>
                                @if($food['average'] > 0)
                                    <span class="text-warning fw-bold">⭐ {{ $food['average'] }}</span>
                                @else
                                    <span class="text-muted">بدون امتیاز</span>
                                @endif
                            </td>
                            <td>
            <span class="badge bg-danger">
                {{ $food['votes'] ?? 0 }} رأی
            </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
