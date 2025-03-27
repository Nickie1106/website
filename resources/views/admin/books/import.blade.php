@extends('layouts.admin')
@section('title', '書籍一括登録')

@section('content')

<div class="container mt-5">
    <h2 class="text-center py-3"><strong>本の一括登録ページ</strong></h2>
    <hr class="border bordre-dark border w-100">

    <form action="{{ route('admin.books.import') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="csvFile" class="form-label">CSVファイルを選択して下さい。</label>
            <input type="file" class="form-control" id="csvFile" name="csvFile" accept=".csv" required>
            <div class="invalid-feedback">CSVを選択してください。</div>
        </div>

        <div class="d-flex justify-content-end py-3">
                    <button type="submit" class="fw-bold btn btn-primary">
                        <i class="fas fa-upload" style="color: white;"></i> アップロード
                    </button>
        </div>
    </form>

    <!--テーブル-->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>本の画像</th>
                    <th>本のタイトル</th>
                    <th>本のジャンル</th>
                    <th>本の著者名</th>
                    <th>本のISBN番号</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>やばい日本史</td>
                    <td>歴史</td>
                    <td>芥川龍之介</td>
                    <td>123-1234567</td>
                    <td>
                    <img src="{{ asset('images/book1.jpg') }}" alt="Book Image" class="img-thumbnail" style="width: 80px; height: auto;">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection