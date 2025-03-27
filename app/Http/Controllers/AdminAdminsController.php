<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Event\ViewEvent;

use function PHPUnit\Framework\returnSelf;

class AdminAdminsController extends Controller
{
    //管理者一覧を表示
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    //新規作成フォーム
    public function create()
    {
        return view('admin.admins.add');
    }

    //新規管理者登録処理
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins.email',
            'password' => 'required|string|min:8',
        ]);

        Admin::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.admins.index')->with('success', '追加が完了しました！');
    }

    //編集フォーム表示
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    //管理者更新処理
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email' . $admin->id,
            'password' => 'nullable|string|min:8',
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
        ]);

        return redirect()->route('admin.admins.index')->with('success', '管理者情報を更新しました！');
    }

    //削除処理
    public function destroy(Admin $admin)
    {
        if($admin->email === 'japan@gmail.com') {
            return redirect()->route('admin.admins.index')->with('error', 'デフォルト管理者は削除できません。');
        }
        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success', '管理者を削除しました');
    }


}
