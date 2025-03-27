@extends('layouts.admin')

@section('title', '書籍追加')

@section('content')
<div class="container py-5">
    <h2 class="text-center py-3"><strong>本の新規追加ページ</strong></h2>
    <hr class="border border-dark w-100">

    <!-- 書籍追加フォーム -->
    <div class="row">
        <div class="col-md-6 text-center mb-3">
            <img src="{{ asset('images/book-placeholder.jpg') }}" alt="Book Image Placeholder" class="img-fluid rounded py-5" id="bookImagePreview">
        </div>

        <!-- 本の詳細 -->
        <div class="col-md-8 col-lg-4">
            <div class="card-body justify-content-start">
            <h4 class="fw-bold text-center py-3">本の詳細</h4>
            <hr class="border border-dark w-100">

            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- タイトル & ジャンル -->
                <div class="mb-3 row">
                    <div class="col-md-5">
                        <label for="title" class="form-label">本のタイトル</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="本のタイトル" required>
                    </div>
                    <div class="col-md-5">
                        <label for="genre_id" class="form-label">ジャンルの選択</label>
                        <select class="form-select" id="genre_id" name="genre_id" required>
                            <option value="">選択</option>
                            <option value="1">総記</option>
                            <option value="2">哲学</option>
                            <option value="3">歴史</option>
                        </select>
                    </div>
                </div>

                <!-- 著者名 & ISBN -->
                <div class="mb-3 row">
                    <div class="col-md-5">
                        <label for="author_name" class="form-label">著者名</label>
                        <input type="text" class="form-control" id="author_name" name="author_name" placeholder="著者名" required>
                    </div>
                    <div class="col-md-5">
                        <label for="isbn" class="form-label">ISBN番号</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN番号" required>
                    </div>
                </div>

                <!-- 画像アップロード -->
                <div class="card mt-4">
                    <div class="card-header bg-outline-primary">
                        <h5 class="mb-0">画像アップロード</h5>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <label for="uploadImage" class="form-label">画像を選択</label>
                            <input type="file" class="form-control" id="uploadImage" name="uploadImage" accept="/image" required>
                        </div>
                    </div>
                </div>

                <!-- 送信ボタン -->
                <div class="text-center py-3">
                    <button type="submit" class="btn btn-primary w-50">追加する</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection
