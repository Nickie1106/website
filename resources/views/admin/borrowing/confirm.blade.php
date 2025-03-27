@extends('layouts.admin')

@section('title', '貸出確認')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-center py-3">貸出確認</h2>

    <div class="alert alert-info text-center">
        以下の内容で貸出を確定します。
    </div>

    <!-- 📌 会員情報の表示 -->
    <div class="mb-4 p-3 border rounded bg-light">
        @if ($user)
            <p class="mb-1 d-flex align-items-center fw-bold text-black">
                <i class="fas fa-id-card fa-sm me-2"></i> {{ $user->member_number }}
            </p>
            <p class="mb-1 d-flex align-items-center fw-bold text-black">
                <i class="fas fa-user fa-sm me-2"></i> {{ $user->name }}
            </p>
            <p class="mb-1 d-flex align-items-center fw-bold">
                <i class="fas fa-phone fa-sm me-2"></i> {{ $user->phone_number }}
            </p>
            <p class="mb-0 d-flex align-items-center fw-bold">
                <i class="fas fa-envelope fa-sm me-2"></i> {{ $user->email }}
            </p>
        @else
            <p class="text-danger fw-bold">⚠ 会員情報が取得できません。</p>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>画像</th>
                    <th>タイトル</th>
                    <th>著者名</th>
                    <th>ジャンル</th>
                    <th>ISBN番号</th>
                </tr>
            </thead>
            <tbody>
            @foreach($borrowedBooks as $book)
                <tr>
                    <td>
                        <img src="{{ asset('assets/images/' . $book->image) }}" 
                            alt="{{ $book->title }}" 
                            class="img-thumbnail rounded" 
                            style="width: 70px; height: auto;">
                    </td>
                    <td class="fw-bold">{{ $book->title }}</td>
                    <td>{{ $book->author_name }}</td>
                    <td>{{ $book->genre->name ?? '不明' }}</td>
                    <td class="text-muted">{{ $book->isbn }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="row text-center mt-4">
        <div class="col-md-4">
            <h5 class="fw-bold text-primary">📅 貸出日</h5>
            <p class="fs-5">{{ $borrowed_at }}</p>
        </div>
        <div class="col-md-4">
            <h5 class="fw-bold text-danger">📆 返却日</h5>
            <p class="fs-5">{{ $due_date }}</p>
        </div>
        <div class="col-md-4">
            <h5 class="fw-bold text-success">📖 合計冊数</h5>
            <p class="fs-5">{{ count($borrowedBooks) }} 冊</p>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="{{ route('admin.borrowing.index') }}" class="btn btn-outline-secondary btn-lg">
            <i class="fas fa-arrow-left"></i> 修正する
        </a>
        <form action="{{ route('admin.borrowing.complete') }}" method="POST">
            @csrf
            <input type="hidden" name="borrowed_at" value="{{ $borrowed_at }}">
            <input type="hidden" name="due_date" value="{{ $due_date }}">
            <button type="submit" class="btn btn-success btn-lg fw-bold">
                貸出を確定する <i class="fas fa-check"></i>
            </button>
        </form>
    </div>
</div>
@endsection
