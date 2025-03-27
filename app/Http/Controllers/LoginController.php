<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest'); // 未ログインユーザーのみアクセス可
    }

    /**
     * ログインフォームを表示する
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * ログイン処理
     */
    public function login(Request $request)
    {
        // バリデーション
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 認証試行
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            // ログイン成功後、トップページにリダイレクト
            return redirect()->route('home');
        }

        // 認証失敗時
        return back()->withErrors([
            'email' => 'ログイン情報が正しくありません。',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
    Auth::logout();

    // セッションを無効化
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // ホーム画面へリダイレクト
    return redirect()->route('home');
    }

}
