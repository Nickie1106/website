@extends('layouts.admin')
@section('title', '書籍一覧')

@section('content')

<div class="container mt-5">
    <h2 class="fw-bold text-center py-3">書籍一覧</h2>
</div>

<!--新規登録と一括登録-->
<div class="row justify-content-end gap-4">
    <div class="col-md-8 d-flex justify-content-end">
        <a href="{{ route('admin.books.add') }}" class="btn btn-outline-secondary">
            <i class="fas fa-plus"></i> 新規登録
        </a>
        <a href="{{ route('admin.books.import') }}" class="btn btn-outline-secondary">
            <i class="fas fa-file-upload"></i> 一括登録
        </a>
    </div>
</div>

<!--書籍一覧-->
<div class="container-fluid py-5">
    <h5 class="text-center py-3"><strong>書籍一覧</strong></h5>
    <div class="row">
        @foreach($books as $index => $book)
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="d-flex justify-content-center align-items-center p-3 bg-light">
                <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 60px; height: auto;">
                </div>

                <div class="card-body">
                    <h5 class="fw-bold card-title text-center mb-3 py-1"><strong>{{ $book->title }}</strong></h5>
                    <hr class="border border-dark border w-100">

                    <p class="card-text"><strong>著者名:</strong> {{ $book->author_name }}</p>
                    <p class="card-text"><strong>ジャンル:</strong> {{ $book->genre_id }}</p>
                    <p class="card-text"><strong>ISBN番号:</strong> {{ $book->isbn }}</p>
                    <p class="card-text"><strong>説明:</strong> 
                    {{ Str::limit($book->description, 30, '...') }}
                    </p>

                    <p class="card-text"><strong>貸出状況:</strong>
                        @if($book->lended)
                        <span class="badge bg-primary">貸出中</span>
                        @else
                        <span class="badge bg-success">返却済み</span>
                        @endif
                    </p>
                </div>

                <div class="card-footer text-center bg-white">
                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning w-100 mb-2">編集</a>
                    <a href="{{ route('admin.books.details', $book->id) }}" class="btn btn-outline-secondary w-100">詳細を見る</a>
                </div>
            </div>
        </div>
        @endforeach 

    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
