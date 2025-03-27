<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .navbar-toggler { border: none; }
        .navbar-toggler:focus { outline: none; }
        .navbar-collapse { transition: max-height 0.5s ease-in-out; }
        .navbar-collapse.collapsing { max-height: 0; }
        .navbar-collapse.show { max-height: 500px; }
        @media (max-width: 991px) {
            .navbar-collapse { display: none; }
            .navbar-toggler { display: block; }
        }
        @media (max-width: 991px) {
            .navbar-collapse.show { display: block; }
        }
        @media (min-width: 992px) {
            .navbar-collapse { display: flex !important; }
            .navbar-toggler { display: none; }
        }
    </style>
</head>
<body>
<header class="text-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="fs-3 mb-0"><a href="{{ route('home') }}" class="text-white text-decoration-none">Library Store</a></h1>

        <!-- ハンバーガーメニュー -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- ナビゲーションメニュー -->
        <nav class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav align-items-center ms-auto">
                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link text-white">ようこそ！ {{ Auth::user()->name }} さん</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link text-white">ホーム</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.books.search') }}" class="nav-link text-white">本一覧</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.mypage.current') }}" class="nav-link text-white">マイページ</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-link nav-link text-white" type="submit">ログアウト</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link text-white">ホーム</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('books.search') }}" class="nav-link text-white">本一覧</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link text-white">ログイン</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link text-white">新規登録</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</header>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
