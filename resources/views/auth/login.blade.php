@extends('layouts.app')

@section('title', 'ورود به حساب کاربری')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm border-0" style="max-width: 500px; margin: 0 auto;">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">ورود به حساب کاربری</h4>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="/login" class="rtl-form">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">ایمیل</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="ایمیل خود را وارد کنید" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">رمز عبور</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="رمز عبور خود را وارد کنید" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">ورود</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p>حساب کاربری ندارید؟ <a href="/register" class="text-success">ثبت‌نام کنید</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
