@extends('layouts.admin')
@section('title', '書籍編集')

@section('content')

<div class="container py-5">
    <h2 class="text-center py-3"><strong>編集</strong></h2>
    <hr class="border border-dark border w-100">

    <!-- 書籍詳細ページ -->
    <div class="row">
        <!-- 左側の画像 -->
        <div class="col-md-6 text-center mb-3">
        <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 100px; height: auto;">
        </div>

        <!-- 右側のフォーム -->
        <div class="col-md-8 col-lg-4">
            <div class="card-body justify-content-start">
                <!-- 本のタイトル -->
                <h4 class="fw-bold card-title text-center py-3" id="book-title">{{ $book->title }}</h4>
                <hr class="border border-dark border w-100">

                <!-- 本の詳細 -->
                <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 row">
                        <div class="col-md-5">
                            <label for="title" class="form-label">本のタイトル</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
                        </div>

                        <div class="col-md-5">
                            <label for="book-genre" class="form-label">ジャンルの選択</label>
                            <select class="form-select" id="book-genre" name="genre_id" required>
                                <option value="1" {{ $book->genre_id == 1 ? 'selected' : '' }}>総記</option>
                                <option value="2" {{ $book->genre_id == 2 ? 'selected' : '' }}>哲学</option>
                                <option value="3" {{ $book->genre_id == 3 ? 'selected' : '' }}>歴史</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-5">
                            <label for="author_name" class="form-label">本の著者名</label>
                            <input type="text" class="form-control" id="author_name" name="author_name" value="{{ $book->author_name }}" required>
                        </div>

                        <div class="col-md-5">
                            <label for="isbn" class="form-label">ISBN番号</label>
                            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn }}" required>
                        </div>
                    </div>

                    <!-- 画像のアップロード -->
                    <div class="card mt-4">
                        <div class="card-header bg-outline-primary">
                            <h5 class="mb-0">画像アップロード</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="uploadImage" class="form-label">画像を選択</label>
                                <input type="file" class="form-control" id="uploadImage" name="uploadImage" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center py-3">
                        <button type="submit" class="btn btn-primary">更新する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
