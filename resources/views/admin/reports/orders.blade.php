@extends('layouts.app')

@section('title', 'گزارش سفارشات')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">📦 گزارش سفارشات</h2>
            <a href="/admin/reports" class="btn btn-outline-secondary">بازگشت</a>
        </div>

        @if(empty($orders) || count($orders) === 0)
            <div class="alert alert-info text-center">هیچ سفارشی ثبت نشده است.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-warning">
                    <tr>
                        <th>کد سفارش</th>
                        <th>کاربر</th>
                        <th>مجموع قیمت</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order['id'] ?? '---' }}</td>
                            <td>{{ $order['user_email'] ?? '---' }}</td>
                            <td>{{ isset($order['total']) ? number_format($order['total']) . ' تومان' : '---' }}</td>
                            <td>
                                <span class="badge bg-{{ ($order['status'] ?? '') === 'completed' ? 'success' : 'secondary' }}">
                                    {{ $order['status'] ?? '---' }}
                                </span>
                            </td>
                            <td>
                                @if(!empty($order['created_at']))
                                    {{ \Carbon\Carbon::parse($order['created_at'])->format('Y-m-d H:i') }}
                                @else
                                    ---
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
