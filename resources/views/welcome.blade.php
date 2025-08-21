@extends('layouts.app')

@section('title', 'رستوران')

@section('content')
    <div class="welcome-text">
        <h2 class="mb-3">سیستم سفارش آنلاین غذا</h2>
        <p>در قسمت بالای صفحه می‌توانید منو را بررسی کرده تا سفارش خود را ثبت کنید و یا وارد حساب کاربری خود شوید.</p>
    </div>

    <div class="gallery">
        @foreach(range(1,12) as $i)
            <div class="gallery-item">
                <img src="{{ asset("images/food$i.jpg") }}" class="gallery-img" alt="غذای رستوران">
            </div>
        @endforeach
    </div>
@endsection
