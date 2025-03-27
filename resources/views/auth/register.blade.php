@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-6">
        <h2 class="fw-bold text-center my-4">アカウント新規登録</h2>
        <form method="POST" action="{{ route('register') }}" class="bg-white rounded shadow-sm p-4" style="min-height: 50vh;">
            @csrf

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                       <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- 姓名入力 -->
            <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" class="form-control" placeholder="例: 山田　太郎" value="{{ old('name') }}" required>
                    </div>
            </div>

            <!-- 電話番号入力 -->
             <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input type="tel" name="phone_number" class="form-control" placeholder="例: 090-1234-5678" value="{{ old('phone_number') }}">
                </div>
             </div>

            <!-- メールアドレス入力 -->
            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="メールアドレス(ログインID)" value="{{ old('email') }}" required>
                </div>
            </div>


            <!-- パスワード入力 -->
        <div class="mb-4">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                       placeholder="8文字以上の英数字" required>
                <span class="input-group-text" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye" id="togglePassword"></i>
                </span>
            </div>
            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- パスワード確認 -->
        <div class="mb-4">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" 
                       placeholder="再度パスワードを入力" required>
            </div>
        </div>

            <script>
                function togglePasswordVisibility() {
                    const passwordInput = document.getElementById('password');
                    const toggleButton = document.getElementById('togglePassword');

                   

                    // パスワードの表示/非表示を切り替える
                    const isPassword = passwordInput.type === 'password';
                    passwordInput.type = isPassword ? 'text' : 'password';


                    //アイコン切り替え
                    toggleIcon.classList.toggle('fa-eye', !isPassword);
                    toggleIcon.classList.toggle('fa-eye-slash', isPassword);
                }
            </script>

            

            <!-- 利用規約の同意 -->
            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="termsCheckbox" name="terms" required>
                    <label class="form-check-label" for="termsCheckbox">
                        <a href="#" class="text-decoration-underline text-danger">利用規約・プライバシーポリシー</a>に同意します。
                    </label>
                </div>
            </div>

            <!-- 登録ボタン -->
            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-register">登録</button>
            </div>

            <hr class="border border-dark w-100">
            <!-- 仕切り線 -->
            <div class="text-center py-3 mb-2">
                <span class="text-muted">各種サービスで登録</span>
            </div>

            <!-- SNSログインアイコン（リンク無し） -->
            <div class="d-flex justify-content-center py-3 mb-3">
                <button class="btn-social btn-line">
                    <i class="fab fa-line"></i>
                </button>
                <button class="btn-social btn-apple">
                    <i class="fab fa-apple"></i>
                </button>
                <button class="btn-social btn-twitter">
                    <i class="fab fa-twitter"></i>
                </button>
                <button class="btn-social btn-facebook">
                    <i class="fab fa-facebook-f"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
