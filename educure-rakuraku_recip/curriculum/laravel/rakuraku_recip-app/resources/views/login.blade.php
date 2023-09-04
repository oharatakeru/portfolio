@extends('layouts.app')

@section('title', 'らくらくレシピ')

@section('content')
    <section>
        <form action="{{ route('login') }}" method="post">
            <h1>ログイン</h1>
            @if (session('login_error'))
                <div class="alert alert-danger">
                    {{ session('login_error') }}
                </div>
            @endif

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
                <input type="password" name="password" id="password" placeholder="パスワード" value="">
            </div>
            <div class="btn mt30">
                <button class="bk_width">ログイン</button>
            </div>

        </form>
        <div class="btn mt30">
            <a class="button-style" href="{{ route('register') }}">初めての方こちら</a>
        </div>
    </section>
@endsection
