<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\BorrowRecord;
use Illuminate\Support\Facades\Session;

class AdminBorrowingController extends Controller
{
    /**
     * 📌 貸出管理トップページ（貸出中の本を取得）
     */

     public function index(Request $request)
{
    $user = null;
    $borrowedBooks = collect(); // 初期値を空のコレクションにする
    $borrowing = null; // 初期値を `null` にする

    if ($request->has('member_number')) {
        $memberNumber = $request->input('member_number');
        $user = User::where('member_number', $memberNumber)->first();

        if ($user) {
            // 📌 貸出中の本を取得
            $borrowedBooks = BorrowRecord::where('user_id', $user->id)
                    ->whereNull('returned_at') // まだ返却されていない本
                    ->with('book')
                    ->get();

            // 📌 何か貸し出し履歴があるなら、最初の1つを取得（適切な方法に変更可能）
            $borrowing = BorrowRecord::where('user_id', $user->id)
                    ->whereNull('returned_at')
                    ->first();
        }
    }

    return view('admin.borrowing.index', compact('user', 'borrowedBooks', 'borrowing'));
}



    /**
     * 📌 選択した会員情報をセッションに保存
     */
    public function selectMember(Request $request)
    {
        $request->validate([
            'member_number' => 'required|exists:users,member_number',
        ]);

        $user = User::where('member_number', $request->member_number)->first();

        if (!$user) {
            return redirect()->route('admin.borrowing.index')->with('error', '会員が見つかりません。');
        }

        session()->put('selected_user', $user);

        return redirect()->route('admin.borrowing.select')->with('success', '会員情報を登録しました。');
    }

    /**
     * 📌 ISBN検索（貸し出す本を探す画面）
     */
    public function select(Request $request)
    {
        $books = Book::all();
        $user = session('selected_user');

        if (!$user) {
            return redirect()->route('admin.borrowing.index')->with('error', 'ユーザー情報がありません。');
        }

        if ($request->has('isbn')) {
            $books = Book::where('isbn', 'like', "%{$request->isbn}%")->get();
        }

        return view('admin.borrowing.select', compact('books', 'user'));
    }

    /**
     * 📌 貸出リストに本を追加
     */
    public function addBook(Request $request, $book_id)
    {
        if (empty($book_id) || !is_numeric($book_id)) {
            return redirect()->route('admin.borrowing.list')->with('error', '無効な本のIDです。');
        }

        $borrowedBookIds = session()->get('borrowed_books', []);

        if (!in_array($book_id, $borrowedBookIds)) {
            $borrowedBookIds[] = $book_id;
        }

        session()->put('borrowed_books', $borrowedBookIds);

        return redirect()->route('admin.borrowing.list');
    }

    /**
     * 📌 貸出リスト画面
     */
    public function list()
    {
        $borrowedBookIds = session()->get('borrowed_books', []);
        $user = session('selected_user');

        if (!$user) {
            return redirect()->route('admin.borrowing.index')->with('error', '失敗しました');
        }

        $borrowedBooks = Book::whereIn('id', $borrowedBookIds)->get();

        return view('admin.borrowing.list', compact('borrowedBooks', 'user'));
    }

    /**
     * 📌 貸出確認画面の表示
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'borrowed_at' => 'required|date',
            'due_date' => 'required|date|after:borrowed_at',
        ]);

        session([
            'borrowed_at' => $request->borrowed_at,
            'due_date' => $request->due_date,
        ]);

        return $this->showConfirm();
    }

    /**
     * 📌 貸出確認画面のデータ取得
     */
    public function showConfirm()
    {
        $borrowed_at = session('borrowed_at');
        $due_date = session('due_date');
        $borrowedBookIds = session('borrowed_books', []);
        $userData = session('selected_user');

        if (!$borrowed_at || !$due_date) {
            return redirect()->route('admin.borrowing.list')->with('error', '貸出日と返却日を指定してください。');
        }

        if (!$userData) {
            return redirect()->route('admin.borrowing.index')->with('error', 'ユーザー情報がありません。');
        }

        $user = User::find($userData['id']);
        if (!$user) {
            return redirect()->route('admin.borrowing.index')->with('error', '会員情報が見つかりません。');
        }

        $borrowedBooks = Book::whereIn('id', $borrowedBookIds)->get();

        return view('admin.borrowing.confirm', compact('borrowed_at', 'due_date', 'borrowedBooks', 'user'));
    }


    //貸出確認コード
    public function complete()
    {
        $borrowed_at = session('borrowed_at');
        $due_date = session('due_date');
        $borrowedBookIds = session('borrowed_books', []);
        $userId = optional(session('selected_user'))->id ?? null;

        try {
            BorrowRecord::insert(array_map(fn($bookId) => [
                'user_id' => $userId,
                'book_id' => $bookId,
                'borrowed_at' => $borrowed_at,
                'due_date' => $due_date,
                'created_at' => now(),
                'updated_at' => now(),
            ], $borrowedBookIds));

            session()->forget(['borrowed_at', 'due_date', 'borrowed_books', 'selected_user']);

        } catch (\Exception $e) {
            return redirect()->route('admin.borrowing.list')->with('error', '貸出確定に失敗しました。');
        }

        return redirect()->route('admin.borrowing.complete')->with('success', '貸出が完了しました。');
    }


    //貸出完了コード
    public function showComplete()
    {
        return view('admin.borrowing.complete');
    }


}
