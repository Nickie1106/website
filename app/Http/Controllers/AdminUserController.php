<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BorrowRecord;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminUserController extends Controller
{
    // ユーザー一覧
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // ユーザー詳細
    public function details($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.details', compact('user'));
    }

    // ユーザー編集
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // ユーザー情報更新
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('admin.users.index')->with('success', 'ユーザー情報を更新しました！');
    }

    // ユーザー削除
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'ユーザー情報を削除しました！');
    }
    
    // 履歴
    public function history($id)
    {
        $user = User::findOrFail($id);
        
        // 借りた本を取得し、関連する本の情報も取得
        $borrowedBooks = BorrowRecord::where('user_id', $id)
            ->with('book') // 本の情報を取得
            ->orderBy('borrowed_at', 'desc')
            ->paginate(10);

        // 総貸出数、未返却数の統計を計算
        $totalBorrowed = $borrowedBooks->count();
        $currentlyBorrowed = $borrowedBooks->filter(function ($borrowedBook) {
            return !$borrowedBook->returned_at; // 未返却の本をカウント
        })->count();

        return view('admin.users.history', compact('user', 'borrowedBooks', 'totalBorrowed', 'currentlyBorrowed'));
    }
}
