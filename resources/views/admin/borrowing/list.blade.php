@extends('layouts.admin')

@section('title', '貸出確認')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold py-3">📖 貸出リスト</h2>
        
        <!-- 📌 会員情報の表示 -->
        <div class="text-end">
            @if ($user)
                <p class="mb-0 fw-bold text-black"><i class="fas fa-id-card"></i> {{ $user->member_number }}</p>
                <p class="mb-1 fw-bold text-black"><i class="fas fa-user"></i> {{ $user->name }}</p>
                <p class="mb-1 fw-bold"><i class="fas fa-phone"></i> {{ $user->phone_number }}</p>
                <p class="mb-0 fw-bold"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
            @else
                <p class="text-danger fw-bold">⚠ 会員情報が取得できません。</p>
            @endif
        </div>
    </div>

    <!-- 📌 貸出日 & 返却日 フォーム -->
    <form action="{{ route('admin.borrowing.confirm') }}" method="POST" class="d-flex gap-3">
        @csrf
        <div class="d-flex align-items-center">
            <label for="borrowed_at" class="me-2 fw-bold">📅 貸出日:</label>
            <input type="date" id="borrowed_at" name="borrowed_at" class="form-control" required style="width: 160px;">
        </div>
        <div class="d-flex align-items-center">
            <label for="due_date" class="me-2 fw-bold">⏳ 返却日:</label>
            <input type="date" id="due_date" name="due_date" class="form-control" required style="width: 160px;">
        </div>
        <button type="submit" class="btn btn-primary fw-bold">
            ✅ 確認
        </button>
    </form>

    <hr class="border border-dark">
</div>

<!-- 📌 貸出リスト -->
<div class="container my-4">
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>📷 画像</th>
                    <th>📖 タイトル</th>
                    <th>🖊 著者名</th>
                    <th>📚 ジャンル</th>
                    <th>🔢 ISBN番号</th>
                    <th>🛠 操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach($borrowedBooks as $book)
            <tr>
                <td>
                    <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 60px; height: auto;">
                </td>
                <td class="text-center">{{ $book->title }}</td>
                <td class="text-center">{{ $book->author_name }}</td>
                <td class="text-center">{{ $book->genre->name ?? '不明' }}</td>
                <td class="text-center">{{ $book->isbn }}</td>
                <td>
                    <form action="{{ route('admin.borrowing.removeBook', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm fw-bold">
                            <i class="fas fa-trash-alt"></i> 削除
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- 📌 合計冊数 -->
<div class="container text-end mt-3">
    <h5>📦 合計冊数: <span class="fw-bold">{{ count($borrowedBooks) }}</span> 冊</h5>
</div>

<!-- 📌 ボタンエリア -->
<div class="container d-flex justify-content-between mt-4">
    <a href="{{ route('admin.borrowing.select') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> 本の追加
    </a>
</div>

<!-- 📌 日付のバリデーション -->
@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date().toISOString().split("T")[0];
        document.getElementById("borrowed_at").setAttribute("min", today);
        document.getElementById("due_date").setAttribute("min", today);
    });
</script>
@endsection

@endsection
