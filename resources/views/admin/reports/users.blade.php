@extends('layouts.app')

@section('title', 'گزارش کاربران')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">👤 کاربران ثبت‌نام‌شده</h2>
            <a href="/admin/reports" class="btn btn-outline-secondary">بازگشت</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>ایمیل</th>
                    <th>نقش</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user['id'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>
                                <span class="badge bg-{{ $user['role'] == 'admin' ? 'danger' : 'primary' }}">
                                    {{ $user['role'] }}
                                </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
