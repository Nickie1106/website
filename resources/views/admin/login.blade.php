<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ログイン</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-light">
        <header class="bg-dark py-3">
            <h1 class="text-center text-white m-0">
                <a href="/" class="text-white text-decoration-none">Library System</a>
            </h1>
        </header>
        <div class="container py-5">
            <h2 class="text-center mb-5">管理者ログイン</h2>
            <form method="POST" action="{{ route('admin.login') }}" class="mx-auto" style="max-width: 500px;">
                @csrf  {{-- CSRF保護 --}}

                <!-- メールアドレス -->
                <div class="mb-4">
                    <label for="email" class="form-label">メールアドレス:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="メールアドレス" required>
                    </div>
                </div>

                <!-- パスワード -->
                <div class="mb-4">
                    <label for="password" class="form-label">パスワード:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="パスワード" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-sm">ログインする</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
