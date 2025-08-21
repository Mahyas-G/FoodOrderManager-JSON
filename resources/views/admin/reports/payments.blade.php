@extends('layouts.app')

@section('title', 'گزارش پرداخت‌ها')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">💳 گزارش پرداخت‌ها</h2>
            <a href="/admin/reports" class="btn btn-outline-secondary">بازگشت</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-success">
                <tr>
                    <th>کد تراکنش</th>
                    <th>مبلغ</th>
                    <th>وضعیت</th>
                    <th>تاریخ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment['id'] }}</td>
                        <td>{{ number_format($payment['amount']) }}هزار تومان</td>
                        <td>
                                <span class="badge bg-{{ $payment['status'] == 'success' ? 'success' : 'danger' }}">
                                    {{ $payment['status'] }}
                                </span>
                        </td>
                        <td>{{ jdate($payment['created_at'])->format('Y/m/d H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
