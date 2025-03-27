@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-6">
        <h2 class="fw-bold text-center my-4">Sign in</h2>

        <!-- 修正済みフォーム -->
        <form class="bg-white rounded shadow-sm p-4" style="min-height: 50vh;" method="POST" action="{{ route('login') }}">
            @csrf <!-- CSRFトークンを追加 -->

            <!-- メールアドレス入力 -->
            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="メールアドレス(ログインID)" required>
                </div>
            </div>

            <!-- パスワード入力 -->
            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="パスワード (8文字以上の英数字)" required>
                </div>
            </div>

            <!-- ログインボタン -->
            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-register">ログイン</button>
            </div>

            <hr class="border border-dark w-100">
            <!-- 仕切り線 -->
            <div class="text-center py-3 mb-2">
                <span class="text-muted">各種サービスでログイン</span>
            </div>

            <!-- サービスアイコン -->
            <div class="d-flex justify-content-center py-3 mb-3">
                <button class="btn-social btn-line" type="button">
                    <i class="fab fa-line"></i>
                </button>
                <button class="btn-social btn-apple" type="button">
                    <i class="fab fa-apple"></i>
                </button>
                <button class="btn-social btn-twitter" type="button">
                    <i class="fab fa-twitter"></i>
                </button>
                <button class="btn-social btn-facebook" type="button">
                    <i class="fab fa-facebook-f"></i>
                </button>
            </div>
        </form>

        <!-- 既存のアカウントリンク -->
        <div class="text-center mt-4">
            <a href="{{ url('/register') }}" class="text-decoration-none">
                <span style="color: black;">アカウントをお持ちでない方はこちら</span>
                <span style="color: #ff9800;">新規登録</span>
            </a>
        </div>
    </div>
</div>
@endsection
