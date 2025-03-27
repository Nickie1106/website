@extends('layouts.admin')

@section('title', '管理者管理')

@section('content')

<div class="container mt-5">
    <h2 class="fw-bold container text-center py-3">管理者管理</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.admins.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> 追加
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>管理者名</th>
                <th>メールアドレス</th>
                <th class="text-center">操作</th>
            </tr>
        </thead>

    <tbody>
    <tr>
       <td>全権利管理者</td>
       <td>japan@gmail.com</td>
       <td class="text-center">
           <a href="{{ route('admin.admins.edit', 1) }}" class="btn btn-primary">
                <i class="fas fa-pencil"></i> 編集
           </a>
           <form action="{{ route('admin.admins.destroy', 1) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> 削除
            </button>
           </form>
       </td>
    </tr>

    <!-- データベースから取得した管理者 -->
    @foreach ($admins as $admin)
    <tr>
       <td>{{ $admin->name }}</td>
       <td>{{ $admin->email }}</td>
       <td class="text-center">
           <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-primary">
                <i class="fas fa-pencil"></i> 編集
           </a>
           <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> 削除
            </button>
           </form>
       </td>
    </tr>
    @endforeach
</tbody>

</table>
</div>
@endsection



