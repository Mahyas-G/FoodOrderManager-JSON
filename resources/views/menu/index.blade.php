@extends('layouts.app')

@section('title', 'منوی غذاها')

@section('content')
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold">منوی غذاها</h2>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($foods as $food)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">

                        @if($food['image_url'])
                            <img src="{{ $food['image_url'] }}"
                                 class="card-img-top"
                                 alt="{{ $food['name'] }}"
                                 style="height:200px; object-fit:cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center"
                                 style="height:200px;">
                                <span class="text-muted">بدون تصویر</span>
                            </div>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title text-warning mb-2">{{ $food['name'] }}</h5>
                            @if(!empty($food['description']))
                                <p class="card-text mb-2">{{ $food['description'] }}</p>
                            @endif
                            <p class="text-success fw-bold mb-3">{{ number_format($food['price']) }} هزار تومان</p>

                            @if(isset($food['average_rating']) && !is_null($food['average_rating']))
                                <div class="text-warning">⭐ میانگین امتیاز: {{ $food['average_rating'] }} / 5</div>
                            @else
                                <div class="text-muted">بدون امتیاز</div>
                            @endif
                        </div>

                        <div class="card-footer bg-transparent border-0 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                            <div class="d-flex gap-2">
                                <a href="{{ route('survey.create', $food['id']) }}" class="btn btn-success">ثبت امتیاز</a>
                                <a href="{{ route('comment.create', $food['id']) }}" class="btn btn-warning text-white">دیدگاه‌ها</a>
                            </div>

                            @if(session('user') && session('user.role') === 'admin')
                                <div class="d-flex gap-2">
                                    <a href="{{ route('menu.edit', $food['id']) }}" class="btn btn-primary">ویرایش</a>

                                    <form method="POST" action="{{ route('menu.delete', $food['id']) }}"
                                          onsubmit="return confirm('آیا از حذف این غذا مطمئن هستید؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">حذف</button>
                                    </form>
                                </div>
                            @endif

                            @if(session('user') && session('user.role') === 'user')
                                <a href="{{ route('orders.create', $food['id']) }}" class="btn btn-outline-primary">
                                    🍽 سفارش غذا
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(session('user') && session('user.role') === 'admin')
            <div class="text-center mt-5">
                <a href="{{ route('menu.create') }}" class="btn btn-primary px-4">افزودن غذای جدید</a>
            </div>
        @endif
    </div>
@endsection
