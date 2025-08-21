@extends('layouts.app')

@section('title', 'گزارش امتیازها')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">⭐ گزارش امتیازها</h2>
            <a href="/admin/reports" class="btn btn-outline-secondary">بازگشت</a>
        </div>

        @if(empty($surveys) || count($surveys) === 0)
            <div class="alert alert-info text-center">هیچ امتیازی ثبت نشده است.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-warning">
                    <tr>
                        <th>غذا</th>
                        <th>امتیاز</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($surveys as $survey)
                        <tr>
                            <td>{{ $survey['food_name'] ?? '---' }}</td>
                            <td>{{ $survey['rating'] ?? '-' }} / 5</td>
                            <td>
                                @if(!empty($survey['created_at']))
                                    {{ \Carbon\Carbon::parse($survey['created_at'])->format('Y-m-d H:i') }}
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
