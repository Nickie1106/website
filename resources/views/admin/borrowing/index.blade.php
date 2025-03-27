@extends('layouts.admin')

@section('content')
<!-- ヘッダーコンテンツ -->
<div class="container mt-5">
            <h2 class="container text-center py-3">貸出、返却管理</h2>
        </div>

        <!-- 会員検索フォーム -->
        <section class="container my-4">
            <h5>会員検索</h5>
            <form action="{{ route('admin.borrowing.index') }}" method="GET" class="d-flex">
                <input type="text" name="member_number" class="form-control me-2" placeholder="会員番号を入力" value="{{ request('member_number') }}">
                <button type="submit" class="btn btn-warning">検索</button>
            </form>
        </section>

        <!-- 会員情報 -->
        @if (request('member_number') && $user)
        <section class="container mb-5">
            <div class="alert alert-secondary">
                <h6 class="text-center py-3"><strong>--会員情報--</strong></h6>
                <hr class="border border-dark border w-100">
                <p class="d-flex container justify-content-center"><strong> 名前:</strong> {{ $user->name }}</p>
                <p class="d-flex container justify-content-center"><strong> 会員番号:</strong> {{ $user->member_number }}</p>
                <p class="d-flex container justify-content-center"><strong> メールアドレス:</strong> {{ $user->email }}</p>
                <p class="d-flex container justify-content-center"><strong> 登録日:</strong> {{ $user->created_at->format('Y-m-d') }}</p>
            </div>
        </section>

        <!-- 貸出エリア -->
        <div class="row">
            <section id="lend-books" class="col-md-6 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">本の貸し出しを開始しますか？</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">新しい本を貸し出す場合は以下をクリックして下さい。</p>
                        <form action="{{ route('admin.borrowing.selectMember') }}" method="POST">
                            @csrf
                            <input type="hidden" name="member_number" value="{{ $user->member_number }}">
                            <button type="submit" class="btn btn-warning btn-sm">貸出する</button>
                        </form>
                    </div>
                </div>
            </section>

            <!-- 返却エリア -->
            <section id="return-books" class="col-md-6 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">本を返却しますか？</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">本を返却する場合は以下をクリックして下さい。</p>
                        @if ($borrowedBooks->isNotEmpty())
                            <a href="{{ route('admin.return.index') }}" class="btn btn-primary btn-sm">返却する</a>
                                
                        @else
                            <p>現在、貸出中の本はありません。</p>
                        @endif
                    </div>
                </div>
            </section>
        </div>
        @endif
    </div>
</div>
@endsection