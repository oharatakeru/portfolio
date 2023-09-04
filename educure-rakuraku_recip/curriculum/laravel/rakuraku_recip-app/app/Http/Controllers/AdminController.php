<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // 管理者画面
    public function index()
    {
        return view('/admin'); 
    }

    public function showUsers() {
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    public function edit(User $user) 
    {
        return view('admin.editUser', compact('user'));
    }

    public function update(Request $request, User $user) 
    {
        $messages = [
            'name.required' => '氏名は必須入力です。',
            'name.max' => '氏名は30字以内でご入力ください。',
            'name.unique' => 'すでに名前が使われています。別の名前を入力してください。',
            'email.required' => 'メールアドレスは必須入力です。',
            'email.email' => 'メールアドレスを正しくご入力ください。',
        ];
    
        $validatedData = $request->validate([
            'name' => 'required|max:30|unique:users,name,' . $user->id,
            'email' => 'required|email',
        ], $messages);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->save();

        if ($request->input('name') == $user->name && $request->input('email') == $user->email) {
            return redirect('/admin/users');
        }
    
        // 実際の更新処理...
        $user->update($validatedData);

        return redirect('/admin/users');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin/users');
    }


}
 