@extends('layouts.user')

@section('content')

<div class="container py-3">
    <h2 class="text-center mb-4">ALL BOOKS</h2>

    <!--本の検索フォーム-->
    <section id="search" class="mb-5">
        <form action="{{ route('books.search') }}" method="GET">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="タイトルや著者名で検索">
                <button type="submit" class="btn btn-warning">検索</button>
            </div>
        </form>
    </section>

    <!--本の一覧-->
    <div class="row">
        @foreach ($books as $book)
            <div class="col-md-3 col-lg-3 mb-4">
                <a href="{{ route('books.details', $book->id) }}" class="card-link">
                    <div class="card book-card h-100">
                        <img src="{{ asset('/assets/images/' . $book->image) }}" alt="Book Image" class="card-img-top" style="max-width: 50px; max-height: 100%; margin: auto; display: block;">
                        <div class="card-body text-center">
                            <h5 class="card-title text-black" style="text-decoration: underline;"><strong>{{ $book->title }}</strong></h5>
                            <p class="card-text text-black mb-2" style="text-decoration: underline;">
                                <i class="fas fa-user"></i> {{ $book->author_name }}
                            </p>

                            @isset($book->genre)
                                <p class="card-text text-black mb-2" style="text-decoration: underline;">
                                    <i class="fas fa-tags"></i> {{ $book->genre->name }}
                                </p>
                            @else
                                <p class="card-text text-black mb-2" style="text-decoration: underline;">
                                    <i class="fas fa-tags"></i> 未分類
                                </p>
                            @endisset

                            <div class="mt-auto">
                                <a href="{{ route('books.details', $book->id) }}" class="btn btn-warning">
                                    <i class="fas fa-eye"></i> 詳細を見る
                                </a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                    </ul>
    </nav>

    
</div>

@endsection
