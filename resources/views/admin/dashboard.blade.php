@extends('layouts.admin')

@section('title', '管理者ダッシュボード')

@section('content')
<div class="container mt-4">
    <h3>ダッシュボード</h3>
    <hr class="dashboard-divider">
    <div class="row g-4 mt-3">
        <div class="col-md-4">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-dark">
                <div class="card text-center p-4">
                    <i class="fas fa-user fa-2x mb-3"></i>
                    <p>ユーザー管理</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.books.index') }}" class="text-decoration-none text-dark">
                <div class="card text-center p-4">
                    <i class="fas fa-book fa-2x mb-3"></i>
                    <p>書籍一覧</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.borrowing.index') }}" class="text-decoration-none text-dark">
                <div class="card text-center p-4">
                    <i class="fas fa-exchange-alt fa-2x mb-3"></i>
                    <p>貸出、返却管理</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.genres.index') }}" class="text-decoration-none text-dark">
                <div class="card text-center p-4">
                    <i class="fas fa-tags fa-2x mb-3"></i>
                    <p>ジャンル管理</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.admins.index') }}" class="text-decoration-none text-dark">
                <div class="card text-center p-4">
                    <i class="fas fa-user-shield fa-2x mb-3"></i>
                    <p>管理者管理</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
