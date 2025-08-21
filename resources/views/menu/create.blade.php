@extends('layouts.app')

@section('title', 'افزودن غذای جدید')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm border-0" style="max-width: 700px; margin: 0 auto;">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">افزودن غذای جدید</h4>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data" class="rtl-form">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">نام غذا</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">توضیحات (اختیاری)</label>
                        <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">قیمت (هزار تومان)</label>
                        <input type="number" class="form-control" name="price" id="price" required>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label">تصویر غذا</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-4">ذخیره غذا</button>
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
            border-color: #449d44;
            box-shadow: 0 0 0 0.25rem rgba(68, 157, 68, 0.25);
        }
    </style>
@endsection
