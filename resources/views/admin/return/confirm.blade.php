@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>✅ 返却が完了しました！</h2>
    <p>本の返却処理が正常に完了しました。</p>
    <a href="{{ route('admin.borrowing.index') }}" class="btn btn-secondary">貸出・返却管理へ戻る</a>
</div>
@endsection
