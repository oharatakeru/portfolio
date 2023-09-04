<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ログイン
    public function showLoginForm()
    {
        return view('/login'); // あなたのログインビューのパスを指定してください
    }

    public function login(Request $request)
    {
        $messages = [
            'name.required' => '氏名は必須入力です。',
            'name.max' => '氏名は30字以内でご入力ください。',
            'email.required' => 'メールアドレスは必須入力です。',
            'email.email' => 'メールアドレスを正しくご入力ください。',
            'password.required' => 'パスワードは必須入力です。',
            'password.min' => 'パスワードは8文字以上の半角でお願いします。',
        ];
    
        $validatedData = $request->validate([
            'name' => 'required|max:30|',
            'email' => 'required|email',
            'password' => 'required|min:8|',
        ], $messages);

        if (Auth::attempt($validatedData)) {
            if (Auth::user()->role == 1) {
                return redirect('/admin');
            } else {
                return redirect('/top');
            }
        } else {
            return redirect()->back()->with('login_error', '認証に失敗しました');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // 新規登録
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $messages = [
            'name.required' => '氏名は必須入力です。',
            'name.max' => '氏名は30字以内でご入力ください。',
            'name.unique' => 'すでに名前が使われています。別の名前を入力してください。',
            'email.required' => 'メールアドレスは必須入力です。',
            'email.email' => 'メールアドレスを正しくご入力ください。',
            'password.required' => 'パスワードは必須入力です。',
            'password.min' => 'パスワードは8文字以上の半角でお願いします。',
            'password.confirmed' => '確認パスワードと違います。もう一度入力してください。'
        ];
    
        $validatedData = $request->validate([
            'name' => 'required|max:30|unique:users',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:0,1'
        ], $messages);
    

        // ユーザーデータの保存
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;  // roleの値を保存
        $user->save();
    
        // 登録後のリダイレクトやメッセージなどの処理
        return redirect('/');
    }    


}
 