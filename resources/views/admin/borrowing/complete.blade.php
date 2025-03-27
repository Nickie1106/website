@extends('layouts.admin')

@section('title', '貸出完了')

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <i class="fas fa-check-circle text-success" style="font-size: 64px;"></i>
        <h2 class="mt-4">貸出が完了しました</h2>
        <p class="mt-3">貸出処理が正常に完了しました。</p>
        
        <div class="mt-5">
            <a href="{{ route('admin.borrowing.list') }}" class="btn btn-primary me-3">
                <i class="fas fa-list"></i> 貸出一覧へ
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                <i class="fas fa-home"></i> ダッシュボードへ
            </a>
        </div>
    </div>
</div>
@endsection