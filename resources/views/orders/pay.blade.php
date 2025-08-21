@extends('layouts.app')

@section('title', 'پرداخت سفارش')

@section('content')
    <div class="container py-4 text-center">
        <h2 class="mb-4">💳 پرداخت سفارش #{{ $order['id'] }}</h2>
        <p>مبلغ قابل پرداخت: <strong>{{ number_format($order['total']) }} تومان</strong></p>

        <form action="{{ route('orders.process', $order['id']) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success btn-lg">پرداخت آنلاین</button>
        </form>
    </div>
@endsection
