<!-- resources/views/mypage.blade.php -->
@extends('layouts.user')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4">マイページ</h2>
    <hr class="border border-dark w-100">

    <!-- タブメニュー -->
    <div class="d-flex justify-content-around py-5">
        <a href="{{ route('mypage.borrowed') }}" class="btn btn-primary w-25 text-center">借りた本の履歴</a>
        <a href="{{ route('mypage.current') }}" class="btn btn-outline-secondary w-25 text-center">現在借りている本</a>
    </div>

    <p class="text-center text-muted py-3">ようこそ！ {{ $user->name }} 様</p>
    <hr class="border border-dark w-100">

    <!--貸出履歴-->
    <div class="container my-5">
        <h2 class="fw-bold mb-4">借りた本の履歴</h2>

        <!--検索フォーム-->
        <form class="row g-3 mb-4 py-5">
            <div class="col-md-4">
                <label for="search-title" class="form-label">本のタイトル</label>
                <input type="text" id="search-title" class="form-control" placeholder="タイトルを入力">
            </div>
            <div class="col-md-3">
                <label for="start-date" class="form-label">開始日</label>
                <input type="date" id="start-date" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="end-date" class="form-label">終了日</label>
                <input type="date" id="end-date" class="form-control">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">履歴を表示</button>
            </div>
        </form>

        <!-- 返却履歴テーブル -->
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>貸出日</th>
                    <th>本の画像</th>
                    <th>本のタイトル</th>
                    <th>返却予定日</th>
                    <th>状態</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowedBooks as $book)
                    <tr>
                        <td>{{ $book->borrowed_at->format('Y/m/d') }}</td>
                        <td class="text-center">
                            <img src="{{ asset('assets/images/' . $book->book->image) }}" class="img-fluid" style="max-width: 80px;" alt="{{ $book->book->title }}">
                        </td>
                        <td>{{ $book->book->title }}</td>
                        <td>{{ $book->due_date->format('Y/m/d') }}</td>
                        <td>
                            @if ($book->returned_at)
                                <span class="badge bg-success">返却済み</span>
                            @else
                                <span class="badge bg-warning text-dark">貸出中</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
