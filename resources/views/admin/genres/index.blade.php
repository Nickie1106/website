@extends('layouts.admin')

@section('title', 'ジャンル管理')

@section('content')

<div class="container mt-5">
    <h2 class="fw-bold container text-center py-3">ジャンル管理</h2>
</div>

<!--ジャンル検索-->
<div class="container my-4">
    <form action="{{ route('admin.genres.index') }}" method="GET" class="d-flex">
        <input type="search" name="search" class="form-control" placeholder="ジャンル名" aria-label="search">
        <button class="btn btn-warning" type="submit">検索</button>
    </form>
</div>

<!--ジャンル一覧-->
<section class="container py-3">
    <h4 class="text-center my-4">ジャンル一覧</h4>
    <table class="table tablr-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>ジャンル名</th>
                <th>説明</th>
            </tr>
        </thead>

        <tbody id="genre-list">
                    <tr>
                        <td>0</td>
                        <td>総記</td>
                        <td>総記に関する書籍</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>哲学</td>
                        <td>哲学に関する書籍</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>歴史</td>
                        <td>歴史に関する書籍</td>
                    </tr>
        </tbody>
    </table>
</section>
@endsection
