<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // resources/views/admin/login.blade.php
    }

    // 管理者ログイン処理
    public function login(Request $request)
    {
        // バリデーション
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // ログイン処理
        if (Auth::guard('admin')->attempt($credentials)) {
            
            return redirect()->route('admin.dashboard');
        }

        // ログイン失敗時
        return back()->withErrors([
            'email' => 'ログイン情報が間違っています。',
        ]);
    }

    // 管理者ダッシュボード
    public function dashboard()
    {
        return view('admin.dashboard'); // resources/views/admin/dashboard.blade.php
    }


    public function logout() 
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
