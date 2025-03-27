@extends('layouts.user')

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-md-4">
           <img src="{{ asset('/assets/images/' . $book->image) }}" alt="Book Image" class="card-img-top" style="max-width: 50px; max-height: 100%; margin: auto; display: block;">
        </div>

        <div class="col-md-8">
            <h2>{{ $book->title }}</h2>
            <p class="text-muted">著者名:
                <i class="fas fa-user"></i> {{ $book->author_name }}
            </p>
            <p class="text-muted">ジャンル:
                <i class="fas fa-tags"></i> {{ $book->genre->name }}
            </p>
            <p>{{ $book->description }}</p>
            <a href="{{ route('books.search') }}" class="btn btn-secondary">戻る</a>                
        </div>
    </div>
</div>
@endsection