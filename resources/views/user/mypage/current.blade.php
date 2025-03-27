@extends('layouts.user')

@section('content')

<div class="container my-5">
    <h2 class="fw-bold mb-4">マイページ</h2>
    <hr class="border border-dark w-100">

    <div class="d-flex justify-content-around py-5">
        <a href="{{ route('mypage.borrowed') }}" class="btn btn-outline-secondary w-25 text-center">借りた本の履歴</a>
        <a href="{{ route('mypage.current') }}" class="btn btn-primary w-25 text-center">借りている本</a>
    </div>

    <p class="text-center text-muted py-3">ようこそ！ {{ $user->name }} 様</p>
    <hr class="border border-dark w-100">

    <h2 class="fw-bold mb-4">現在借りている本</h2>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>貸出日</th>
                <th>本の画像</th>
                <th>本のタイトル</th>
                <th>返却予定日</th>
                <th>状態</th>
            </tr>
        </thead>

        <tbody>
            @foreach($currentBooks as $book)
            <tr>
                <td class="text-center">{{ $book->borrowed_at->format('Y/m/d') }}</td>
                <td class="text-center">
                <img src="{{ asset('assets/images/' . $book->book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 100px; height: auto; object-fit: cover;">
                </td>
                <td class="text-center">{{ $book->book->title }}</td>
                <td class="text-center">{{ $book->due_date->format('Y/m/d') }}</td>
                <td class="text-center">
                    <span class="badge bg-warning text-dark">貸出中</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>    

    <!--アラート-->
    @if($upcomingDueBooks->count() > 0) 
    <div class="alert alert-warning">
        <h5>📅 返却期限が近い本があります！</h5>
        <ul>
            @foreach($upcomingDueBooks as $book)
            <li>{{ $book->title }} - 返却期限: {{ $book->due_date->format('Y/m/d') }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if($overdueBooks->count() > 0)
    <div class="alert alert-danger">
        <h5>🔔 返却期限を過ぎた本があります！</h5>
        <ul>
            @foreach($overdueBooks as $book)
            <li>{{ $book->title }} - 返却期限: {{ $book->due_date->format('Y/m/d') }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

@endsection
