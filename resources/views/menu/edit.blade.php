@extends('layouts.app')

@section('title', 'ویرایش غذا')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm border-0" style="max-width: 700px; margin: 0 auto;">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0">ویرایش غذا: {{ $food['name'] }}</h4>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('menu.update', $food['id']) }}" enctype="multipart/form-data" class="rtl-form">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">نام غذا</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $food['name'] }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">توضیحات (اختیاری)</label>
                        <textarea class="form-control" name="description" id="description" rows="4">{{ $food['description'] ?? '' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">قیمت (تومان)</label>
                        <input type="number" class="form-control" name="price" id="price" value="{{ $food['price'] }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label">تصویر غذا (در صورت تغییر انتخاب کنید)</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        @if(isset($food['image']) && !empty($food['image']))
                            <div class="mt-2">
                                <img src="{{ asset('storage/images/' . $food['image']) }}" alt="{{ $food['name'] }}" style="width: 120px; border-radius: 8px;">
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning text-white px-4">به‌روزرسانی غذا</button>
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
        .card {
            border-radius: 10px;
        }
        .form-control {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #e0a800;
            box-shadow: 0 0 0 0.25rem rgba(224, 168, 0, 0.25);
        }
    </style>
@endsection
