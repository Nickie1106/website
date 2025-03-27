@extends('layouts.admin')

@section('title', 'ユーザー管理画面')

@section('content')

<div class="container mt-5">
    <h2 class="fw-bold text-center py-3">ユーザー管理</h2>
</div>

<!-- 検索フォーム -->
<form class="mb-4">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="会員番号、氏名、メールアドレス、電話番号で検索">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i> 検索
        </button>
    </div>
</form>

<!-- ユーザー一覧 -->
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>会員番号</th>
                <th>氏名</th>
                <th>メールアドレス</th>
                <th>電話番号</th>
                <th>登録日</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
         
            @foreach($users as $user)
            <tr>
                <td>{{ $user->member_number }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                <td>
    <a href="{{ route('admin.users.details', ['id' => $user->id]) }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-eye"></i> 詳細
    </a>

    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
        <i class="fas fa-edit"></i> 編集
    </a>

    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当に削除しますか？')">
            <i class="fas fa-trash-alt"></i> 削除
        </button>
    </form>
    
    <!-- 貸出履歴ボタン -->
    <a href="{{ route('admin.users.history', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">
        <i class="fas fa-book"></i> 貸出履歴
    </a>

    <!-- 返却管理ボタン -->
    <a href="{{ route('admin.return.index') }}" class="btn btn-success btn-sm">
        <i class="fas fa-tshirt"></i> 返却管理
    </a>
</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
