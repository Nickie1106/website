@extends('layouts.user')

@section('content')

<main>
    <!--背景画像-->
    <section class="main-background">
        <div class="container text-center text-white py-5">
            <h1 class="fw-bold">Welcome to Library Store</h1>
            <p class="lead">Find your next favorite book from our extensive collection.</p>
        </div>
    </section>

    <!--ジャンルセクション-->
    <section class="genre-background">
        <div class="container text-center">
            <h3 class="fw-bold text-center py-3">ALL GENRES</h3>
            <div class="row text-center">
                <!-- 総記 -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="icon-container mb-3">
                                <i class="fas fa-book fa-4x text-success"></i>
                            </div>
                            <h5 class="fw-bold mb-3">総記</h5>
                            <p class="text-muted">Explore general knowledge books and resources.</p>
                        </div>
                    </div>
                </div>
                <!-- 哲学 -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="icon-container mb-3">
                                <i class="fas fa-brain fa-4x text-primary"></i>
                            </div>
                            <h5 class="fw-bold mb-3">哲学</h5>
                            <p class="text-muted">Dive into philosophical thoughts and works.</p>
                        </div>
                    </div>
                </div>
                <!-- 歴史 -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="icon-container mb-3">
                                <i class="fas fa-landmark fa-4x text-warning"></i>
                            </div>
                            <h5 class="fw-bold mb-3">歴史</h5>
                            <p class="text-muted">Discover history from around the world.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 本一覧セクション -->
    <section class="card-background">
        <div class="container text-center">
            <h3 class="fw-bold text-center py-3">ALL BOOKS</h3>

            <div class="row g-4">
                @isset($books)
                    @foreach ($books as $book)
                        <div class="col-md-4 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm d-flex flex-column">
                                <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                                    <img src="{{ asset('assets/images/' . $book->image) }}" alt="Book Image" class="img-thumbnail" style="max-height: 100%; width: auto; object-fit: cover;">
                                </div>

                                <div class="card-body d-flex flex-column text-center">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <p class="card-text">著者: {{ $book->author_name }}</p>
                                    <p class="text-muted flex-grow-1">
                                        概要: {{ Str::limit($book->description, 70) }}
                                        <a href="{{ route('books.details', ['id' => $book->id]) }}" class="text-muted">...</a>
                                    </p>

                                    <div class="mt-auto">
                                        @if($book->status === '貸出中')
                                            <p class="fw-bold btn btn-warning btn-sm w-100">貸出中</p>
                                            <p class="fw-bold">返却予定日: {{ $book->return_date }}</p>
                                        @else
                                            <p class="fw-bold btn btn-success btn-sm w-100">返却済み</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>本が見つかりません。</p>
                @endisset
            </div>

            <!-- ページネーション -->
            <nav class="d-flex justify-content-center py-4 mt-4">
                {{ $books->links('pagination::bootstrap-4')}}

            </nav>
        </div>
    </section>
</main>

@endsection
