<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'رستوران')</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <link href="https://cdn.fontcdn.ir/Font/Persican/Vazir/Vazir.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            width: 100%;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Vazir', sans-serif;
            background-color: #faf8f1;
            color: #3e3e3e;
            display: flex;
            flex-direction: column;
        }

        nav.navbar {
            background-color: #449d44;
            min-height: 70px;
            margin: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        main {
            flex: 1;
            overflow-y: auto;
            padding-top: 0;
            -ms-overflow-style: none;
            scrollbar-width: none;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        main::-webkit-scrollbar {
            display: none;
        }

        footer {
            background-color: #449d44;
            color: #fff;
            text-align: center;
            padding: 15px 0;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            width: 90%;
            max-width: 1200px;
            padding: 20px 0;
        }

        .gallery-item {
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .welcome-text {
            text-align: center;
            margin: 30px 0;
            width: 90%;
            max-width: 800px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="{{ url('/') }}">🍽 رستوران</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="{{ url('/menu') }}">منو</a>
                </li>

                @if(session('user'))
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="{{ url('/dashboard') }}">داشبورد</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ url('/logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">خروج</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="{{ route('login') }}">ورود</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="{{ route('register') }}">ثبت‌نام</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if(session('success'))
        <div class="alert alert-success w-100">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger w-100">{{ session('error') }}</div>
    @endif

    @yield('content')
</main>

<footer>
    <p>© {{ date('Y') }} تمامی حقوق محفوظ است.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
