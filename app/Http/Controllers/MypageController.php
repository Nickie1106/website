<?php

namespace App\Http\Controllers;

use App\Models\BorrowRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MypageController extends Controller
{
    
    public function mypage()
    {
        $user = Auth::user();

        //認証チェック
        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }


        //ユーザー情報と借りた本の取得
        $currentBooks = BorrowRecord::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->get();  
            
        //upcomingDueBooks と overdueBooks を取得
        $upcomingDueBooks = BorrowRecord::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->whereDate('due_date', '<', now())
            ->get();
        
        $overdueBooks = BorrowRecord::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->whereDate('due_date', '<', now())
            ->get();

        return view('user.mypage.current', compact('user', 'currentBooks', 'upcomingDueBooks', 'overdueBooks'));
    }



    public function current()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        //借りている本の取得
        $currentBooks = BorrowRecord::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->get();

        //期限が近い本の取得
        $upcomingDueBooks = BorrowRecord::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->whereDate('due_date', '>=', now()->addDays(3))
            ->get();

        //返却期限を過ぎた本の取得
        $overdueBooks = BorrowRecord::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->whereDate('due_date', '<', now())
            ->get();

        return view('user.mypage.current', compact('currentBooks', 'user', 'upcomingDueBooks', 'overdueBooks'));
    }


    public function borrowed()
    {
        $user = Auth::user();

        //認証チェック
        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインして下さい');
        }

        //借りた本の取得
        $borrowedBooks = BorrowRecord::where('user_id', $user->id)
            ->orderBy('borrowed_at', 'asc')
            ->get();

        //統計データ
        $totalBorrowed = $borrowedBooks->count();
        $currentlyBorrowed = $borrowedBooks->whereNull('returned_at')->count();

        return view('user.mypage.borrowed', compact('borrowedBooks', 'user', 'totalBorrowed', 'currentlyBorrowed'));
    }
}
