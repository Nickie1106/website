@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold py-3">📚 {{ $user->name }} 様の貸出履歴</h2>
        <div class="text-end">
            @if ($user)
                <p class="mb-0 fw-bold text-black"><i class="fas fa-id-card"></i> 会員番号: {{ $user->member_number }}</p>
                <p class="mb-1 fw-bold text-black"><i class="fas fa-user"></i> 名前: {{ $user->name }}</p>
                <p class="mb-1 fw-bold"><i class="fas fa-phone"></i> 電話番号: {{ $user->phone_number }}</p>
                <p class="mb-0 fw-bold"><i class="fas fa-envelope"></i> メール: {{ $user->email }}</p>
            @else
                <p class="text-danger fw-bold">⚠ 会員情報が取得できません。</p>
            @endif
        </div>
    </div>
    <hr class="border border-dark">
</div>

<div class="container my-4">
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>📷 画像</th>
                    <th>📖 本のタイトル</th>
                    <th>📅 貸出日</th>
                    <th>📅 返却予定日</th>
                    <th>📅 返却日</th>
                    <th>📊 ステータス</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowedBooks as $borrowRecord)
                    <tr>
                        <td>
                            <img src="{{ asset('assets/images/' . $borrowRecord->book->image) }}" alt="{{ $borrowRecord->book->title }}" class="img-thumbnail" style="width: 60px; height: auto;">
                        </td>
                        <td class="text-start"><strong>{{ $borrowRecord->book->title ?? '不明' }}</strong></td>
                        <td>{{ \Carbon\Carbon::parse($borrowRecord->borrowed_at)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($borrowRecord->due_date)->format('Y-m-d') }}</td>
                        <td>{{ $borrowRecord->returned_at ? \Carbon\Carbon::parse($borrowRecord->returned_at)->format('Y-m-d') : '未返却' }}</td>
                        <td>
                            @if($borrowRecord->returned_at)
                                <span class="badge bg-success">返却済</span>
                            @else
                                <span class="badge bg-warning">貸出中</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- ページネーション -->
    <div class="d-flex justify-content-center mt-3">
        {{ $borrowedBooks->links() }}
    </div>

    <div class="text-end mt-3">
        <a href="{{ route('mypage.current') }}" class="btn btn-secondary">現在借りている本に戻る</a>
    </div>
</div>

<div class="container mt-5">
    <h4 class="fw-bold">📊 貸出履歴の統計</h4>
    <ul class="list-group">
        <li class="list-group-item">総貸出数: {{ $totalBorrowed }} 冊</li>
        <li class="list-group-item">未返却数: {{ $currentlyBorrowed }} 冊</li>
    </ul>
</div>

@endsection
