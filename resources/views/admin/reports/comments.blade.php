@extends('layouts.app')

@section('title', 'گزارش دیدگاه‌ها')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">💬 گزارش دیدگاه‌ها</h2>
            <a href="{{ route('admin.reports') }}" class="btn btn-outline-secondary">بازگشت</a>
        </div>

        @if(empty($comments) || count($comments) === 0)
            <div class="alert alert-info text-center">هیچ دیدگاهی ثبت نشده است.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-warning">
                    <tr>
                        <th>غذا</th>
                        <th>کاربر</th>
                        <th>متن دیدگاه</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{ $comment['food_name'] ?? '---' }}</td>
                            <td>{{ $comment['user_email'] ?? '---' }}</td>
                            <td>{{ $comment['text'] ?? '---' }}</td>
                            <td>
                                @if(!empty($comment['created_at']))
                                    {{ \Carbon\Carbon::parse($comment['created_at'])->format('Y-m-d H:i') }}
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
