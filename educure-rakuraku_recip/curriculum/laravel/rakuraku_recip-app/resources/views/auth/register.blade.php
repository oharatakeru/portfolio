@extends('layouts.app')

@section('title', 'らくらくレシピ')

@section('content')
    <section>
        <form action="{{ route('register') }}" method="post">
        <h1>新規登録</h1>
            @csrf
            <div class="mt30">
                <label for="name">名前</label>
            </div>
            <div>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="text" name="name" id="name" placeholder="山田太郎" value="{{ old('name') }}">
            </div>

            <div class="mt30">
                <label for="email">メールアドレス</label>
            </div>
            <div>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="text" name="email" id="email" placeholder="メールアドレス" value="{{ old('email') }}">
            </div>

            <div class="mt30">
                <label for="password">パスワード</label>
            </div>
            <div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="password" name="password" id="password" placeholder="パスワード" value="{{ old('password') }}">
            </div>

            <div class="mt30">
                <label for="password_confirmation">確認パスワード</label>
            </div>
            <div>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="確認パスワード">
            </div>

            <div class="mt30">
                <label for="role">ユーザー属性:</label>
            </div>
            <div>
                @error('role')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <select name="role" id="role">
                    <option value="0">一般ユーザー</option>
                    <option value="1">管理ユーザー</option>
                </select>
            </div>
            <div class="btn mt30">
                <button class="bk_width">新規登録</button>
            </div>
        </form>
    </section>
@endsection
