@extends('layouts.app')

@section('title', 'داشبورد')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">👤 خوش آمدید {{ $user->name ?? '' }}</h2>
        <p>شما وارد حساب کاربری خود شده‌اید. از منو برای سفارش غذا یا مشاهده دیدگاه‌ها استفاده کنید.</p>
    </div>
@endsection
