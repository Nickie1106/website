@extends('layouts.admin')

@section('title', '返却確認')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold py-3">📖 返却処理リスト</h2>
        <div class="text-end">
            @if ($user)
                <p class="mb-0 fw-bold text-black"><i class="fas fa-id-card"></i> {{ $user->member_number }}</p>
                <p class="mb-1 fw-bold text-black"><i class="fas fa-user"></i> {{ $user->name }}</p>
                <p class="mb-1 fw-bold"><i class="fas fa-phone"></i> {{ $user->phone_number }}</p>
                <p class="mb-0 fw-bold"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
            @else
                <p class="text-danger fw-bold">⚠ 会員情報が取得できません。</p>
            @endif
        </div>
    </div>
    <hr class="border border-dark">
</div>

<div class="container my-4">
    <form action="{{ route('admin.return.confirm') }}" method="POST">
        @csrf
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>✅ 選択</th>
                        <th>📷 画像</th>
                        <th>📖 書籍情報</th>
                        <th>📚 ジャンル</th>
                        <th>🔢 ISBN番号</th>
                        <th>📅 貸出・返却情報</th>
                        <th>📋 ステータス</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($borrowedBooks as $record)
                <tr>
                    <td><input type="checkbox" name="returned_books_ids[]" value="{{ $record->id }}"></td>
                    <td><img src="{{ asset('assets/images/' . $record->book->image) }}" alt="{{ $record->book->title }}" class="img-thumbnail" style="width: 60px; height: auto;"></td>
                    <td class="text-start">
                        <span class="fw-bold">{{ $record->book->title }}</span><br>
                        <small class="text-muted">🖊 {{ $record->book->author_name }}</small>
                    </td>
                    <td>{{ $record->book->genre->name ?? '不明' }}</td>
                    <td>{{ $record->book->isbn }}</td>
                    <td class="text-start">
                        <div class="border rounded p-2 bg-light">
                            <p class="mb-1"><i class="fas fa-calendar-alt text-primary"></i> <strong class="text-primary">貸出日:</strong> {{ $record->borrowed_at->format('Y-m-d') }}</p>
                            <p class="mb-1"><i class="fas fa-hourglass-half text-danger"></i> <strong class="text-danger">返却期限:</strong> 
                                <input type="date" name="due_date[{{ $record->id }}]" value="{{ $record->due_date->format('Y-m-d') }}" class="form-control text-center due-date w-auto d-inline-block">
                            </p>
                        </div>
                    </td>
                    <td>
                        <span class="{{ $record->returned_at ? 'text-success' : 'text-danger' }}">
                            {{ $record->returned_at ? '返却済み' : '未返却' }}
                        </span>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-end mt-3">
            <button type="submit" class="btn btn-danger">返却を確定</button>
        </div>
    </form>
</div>

<div class="container text-end mt-3">
    <form action="{{ route('admin.return.updateDueDate') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">📅 期限を更新</button>
    </form>
</div>

<div class="container text-end mt-3">
    <h5>📦 合計冊数: <span class="fw-bold">{{ count($borrowedBooks) }}</span> 冊</h5>
</div>
@endsection
