@extends('layouts.admin')

@section('title', '管理者管理')

@section('content')

<div class="container mt-5">
    <h2 class="fw-bold text-center py-3">編集画面</h2>

    <div class="d-flex justify-content-center">
        <div class="card p-4" style="max-width: 400px; width:100%">
            <div class="card-header text-center">
                <h4 class="fw-bold">編集画面</h4>
            </div>

            <form action="{{ route('admin.admins.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="admin-name" class="form-label">管理者名:</label>
                    <input type="text" class="form-control" id="admin-name" name="name" placeholder="管理者名を入力" required>
                </div>

                <div class="mb-3">
                    <label for="admin-email" class="form-label">メールアドレス:</label>
                    <input type="email" class="form-control" id="admin-email" name="email" placeholder="メールアドレスを入力" required>
                </div>

                <div class="mb-3">
                    <label for="admin-password" class="form-label">パスワード:</label>
                    <input type="password" class="form-control" id="admin-password" name="password" placeholder="パスワードを入力" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">登録</button>
                    <a href="{{ route('admin.admins.index') }}" class="btn btn-outline-secondary">戻る</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection