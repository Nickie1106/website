@extends('layouts.admin')

@section('title', '貸出管理')

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-center py-3 fw-bold">貸出管理</h2>

        <!-- ログイン中のユーザー情報 -->
        <div>
            @isset($user)
            <p class="mb-0 fw-bold text-black"><i class="fas fa-id-card"></i> {{ $user->member_number }}</p>
                <p class="mb-1 fw-bold text-black"><i class="fas fa-user"></i> {{ $user->name }}</p>
                <p class="mb-1 fw-bold"><i class="fas fa-phone"></i> {{ $user->phone_number }}</p>
                <p class="mb-0 fw-bold"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
            @else
            <p>ユーザー情報がありません。</p>
            @endisset
        </div>
    </div>

    <hr class="border border-dark w-100">
</div>

<section class="container my-4">
    <h4>ISBN検索</h4>
    <form class="d-flex">
        <input type="text" class="form-control me-2" placeholder="例: 978-....">
        <button type="submit" class="fw-bold btn btn-warning">検索</button>
    </form>
</section>

<!-- 検索結果 -->
<section class="mb-5">
    <h5 class="text-center mb-3">検索結果</h5>
    <div class="container">
        <div class="row g-3">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>画像</th>
                            <th>タイトル</th>
                            <th>著者名</th>
                            <th>ジャンル</th>
                            <th>ISBN番号</th>
                            <th>貸出状況</th>
                            <th>返却期限日</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
    @isset($books)
        @foreach($books as $book)
            <tr>
                @if(is_object($book))
                    <td>
                        <img src="{{ asset('assets/images/' . $book->image) }}" 
                             alt="{{ $book->title }}" 
                             class="img-thumbnail" 
                             style="width: 60px; height: auto;">
                    </td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author_name }}</td>
                    <td>{{ $book->genre->name ?? '不明' }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->status }}</td>
                    <td>{{ $book->return_date }}</td>
                    <td class="text-center">
                        <form action="{{ route('admin.borrowing.addBook', ['book_id' => $book->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">追加</button>
                        </form>
                    </td>
                @else
                    <td colspan="8" class="text-center">データが正しくありません</td>
                @endif
            </tr>
        @endforeach
    @endisset
</tbody>

                </table>
            </div>
        </div>
    </div>
</section>

<!-- 次へボタン -->
<div class="d-flex justify-content-center align-items-center mb-3">
    <a href="{{ route('admin.borrowing.list') }}" class="btn btn-primary">次へ</a>
</div>

@endsection
