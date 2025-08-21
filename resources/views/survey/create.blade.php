@extends('layouts.app')

@section('title', 'ثبت امتیاز درباره غذا')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm border-0" style="max-width: 600px; margin: 0 auto;">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">ثبت امتیاز درباره: {{ $food['name'] ?? 'غذا' }}</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('survey.store', ['food_id' => $food['id']]) }}" class="rtl-form">
                    @csrf

                    <div class="mb-4">
                        <label for="rating" class="form-label">امتیاز شما (از 1 تا 5)</label>
                        <select class="form-select" name="rating" id="rating" required>
                            <option value="" selected disabled>لطفاً امتیاز خود را انتخاب کنید</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">
                                    @for($j = 1; $j <= $i; $j++)
                                        ⭐
                                    @endfor
                                    ({{ $i }})
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-info text-white px-4">ثبت امتیاز</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .rtl-form { direction: rtl; text-align: right; }
        .card { border-radius: 10px; }
        .form-select {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            padding: 0.5rem 1rem;
        }
        .form-select:focus {
            border-color: #17a2b8;
            box-shadow: 0 0 0 0.25rem rgba(23, 162, 184, 0.25);
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
    </style>
@endsection
