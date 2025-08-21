@extends('layouts.app')

@section('title', 'دیدگاه‌ها و ثبت نظر')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm border-0" style="max-width: 800px; margin: 0 auto;">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0">دیدگاه‌ها درباره {{ $food['name'] }}</h4>
            </div>

            <div class="card-body">
                @if(count($comments) > 0)
                    <ul class="list-group mb-4">
                        @foreach($comments as $comment)
                            <li class="list-group-item">
                                <strong>کاربر {{ $comment['user_id'] }}:</strong>
                                <p class="mb-1">{{ $comment['comment'] ?? '' }}</p>
                                <small class="text-muted">{{ $comment['date'] }}</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">هنوز دیدگاهی ثبت نشده است.</p>
                @endif

                <form method="POST" action="{{ route('comment.store', $food_id) }}" class="rtl-form">
                    @csrf
                    <div class="mb-4">
                        <label for="comment" class="form-label">دیدگاه شما</label>
                        <textarea class="form-control" name="comment" id="comment" rows="4" required></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('menu.index') }}" class="btn btn-outline-secondary">بازگشت</a>
                        <button type="submit" class="btn btn-warning text-white px-4">ارسال دیدگاه</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .rtl-form {
            direction: rtl;
            text-align: right;
        }
    </style>
@endsection
