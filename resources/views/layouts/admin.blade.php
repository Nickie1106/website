<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/styles.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <!-- admin_サイドバー -->
        <aside class="sidebar">
            <h1 class="sidebar-title">Library System</h1>
            <hr class="dashboard-divider">
            <nav>
                <ul>
                    <li class="side-navi-section-end active">
                        <a href="{{ route('admin.dashboard') }}" class="active">
                            <div class="side-navi-icon">
                                <i class="fas fa-home"></i> ダッシュボード
                            </div>
                        </a>
                    </li>
                    <li class="side-navi-section-end">
                        <a href="{{ route('admin.users.index') }}">
                            <div class="side-navi-icon">
                                <i class="fas fa-user"></i> ユーザー管理
                            </div>
                        </a>
                    </li>
                    <li class="side-navi-section-end">
                        <a href="{{ route('admin.books.index') }}">
                            <div class="side-navi-icon">
                                <i class="fas fa-book"></i> 書籍一覧
                            </div>
                        </a>
                    </li>
                    <li class="side-navi-section-end">
                        <a href="{{ route('admin.borrowing.index') }}">
                            <div class="side-navi-icon">
                                <i class="fas fa-exchange-alt"></i> 貸出、返却管理
                            </div>
                        </a>
                    </li>
                    <li class="side-navi-section-end">
                        <a href="{{ route('admin.genres.index') }}">
                            <div class="side-navi-icon">
                                <i class="fas fa-tags"></i> ジャンル管理
                            </div>
                        </a>
                    </li>
                    <li class="side-navi-section-end">
                        <a href="{{ route('admin.admins.index') }}">
                            <div class="side-navi-icon">
                                <i class="fas fa-user-shield"></i> 管理者管理
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- メインコンテンツ -->
        <div class="main-content">
            <header id="admin-header" class="d-flex justify-content-between align-items-center p-3 bg-light">
                <div>{{ Auth::guard('admin')->user()->name ?? '管理者' }}</div>
                <div class="d-flex gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-house"></i> ホーム
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="fas fa-sign-out-alt"></i> ログアウト
                        </button>
                    </form>
                </div>
            </header>

            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
