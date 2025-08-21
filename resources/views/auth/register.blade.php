@extends('layouts.app')

@section('title', 'ثبت‌نام کاربر جدید')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm border-0" style="max-width: 500px; margin: 0 auto;">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">ثبت‌نام کاربر جدید</h4>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="/register" class="rtl-form">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">ایمیل</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="ایمیل خود را وارد کنید" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">رمز عبور</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="رمز عبور حداقل 6 کاراکتر" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">ثبت‌نام</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p>قبلاً ثبت‌نام کرده‌اید؟ <a href="/login" class="text-primary">ورود به حساب کاربری</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
