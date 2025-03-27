@extends('layouts.admin')

@section('title', 'ユーザー詳細')

@section('content')

<div class="container mt-5">
    <h2 class="fw-bold text-center mb-4">ユーザー詳細</h2>

    <div class="card mx-auto shadow-sm mb-5" style="max-width: 600px;">
        <div class="card-header bg-dark text-white text-center">
            <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
        </div>
        <div class="card-body p-4">
            <p><strong>会員番号:</strong> {{ $user->member_number }}</p>
            <p><strong>電話番号:</strong> {{ $user->phone }}</p>
            <p><strong>メールアドレス:</strong> {{ $user->email }}</p>
            <p><strong>登録日:</strong> {{ $user->created_at->format('Y-m-d') }}</p>
        </div>
    </div>

     <!-- 貸出履歴 -->
     <h3 class="text-center mb-4">貸出履歴</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>本の画像</th>
                    <th>ISBN番号</th>
                    <th>タイトル</th>
                    <th>貸出日</th>
                    <th>返却期限日</th>
                    <th>ステータス</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">
                        <img src="{{ asset('images/book4.jpg') }}" alt="やばい日本史" class="img-thumbnail" style="width: 60px; height: auto;">
                    </td>
                    <td>123-123456789</td>
                    <td>「リーダブルコード」</td>
                    <td>2025-01-15</td>
                    <td>2025-02-01</td>
                    <td><span class="badge bg-warning">貸出中</span></td>
                </tr>

                <tr>
                    <td class="text-center">
                        <img src="{{ asset('images/book6.jpg') }}" alt="やばい日本史" class="img-thumbnail" style="width: 60px; height: auto;">
                    </td>
                    <td>123-123456789</td>
                    <td>「Laravel入門」</td>
                    <td>2024-12-20</td>
                    <td>2025-01-10</td>
                    <td><span class="badge bg-success">返却済</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
