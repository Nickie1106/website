<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowRecord;
use App\Models\User;

class AdminReturnController extends Controller
{
    /**
     * 📌 返却トップページ（未返却の本を取得）
     */
    public function index(Request $request)
{
    

    // セッションから選択されたユーザーを取得
    $user = null;
    $borrowedBooks = collect();

    if ($request->session()->has('selected_user')) {
        $user = $request->session()->get('selected_user');
        

        if ($user) {
            // 📌 貸出中の本を取得（未返却のもの）
            $borrowedBooks = BorrowRecord::where('user_id', $user->id)
                ->whereNull('returned_at')
                ->with(['book', 'book.genre'])
                ->get();
        } else {
            return redirect()->route('admin.return.index')->with('error', '会員が見つかりません。');
        }

        dd('user');
    }

    return view('admin.return.index', compact('user', 'borrowedBooks'));
}



    

    /**
     * 📌 返却処理
     */
    public function confirm(Request $request)
    {
        $validated = $request->validate([
            'returned_books_ids' => 'required|array|min:1',
            'returned_books_ids.*' => 'exists:borrow_records,id',
        ]);

        // 返却処理（returned_at を現在時刻に更新）
        BorrowRecord::whereIn('id', $validated['returned_books_ids'])->update(['returned_at' => now()]);

        return redirect()->route('admin.return.index')->with('success', '返却が完了しました。');
    }

    /**
     * 📌 返却期限の更新
     */
    public function updateDueDate(Request $request)
    {
        $validatedData = $request->validate([
            'due_date' => 'array',
            'due_date.*' => 'required|date|after_or_equal:today',
        ]);

        foreach ($validatedData['due_date'] as $borrowId => $newDueDate) {
            $borrowedRecord = BorrowRecord::find($borrowId);
            if ($borrowedRecord) {
                $borrowedRecord->due_date = $newDueDate;
                $borrowedRecord->save();
            }
        }

        return redirect()->back()->with('success', '返却期限を更新しました。');
    }
}
