@extends('layouts.app')

@section('title', 'らくらくレシピ')

@section('content')
    <section>
        <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="post">
            <h1>ユーザー編集</h1>
                @csrf
                <div class="mt30">
                    <label for="name">名前</label>
                </div>
                <div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input type="text" name="name" id="name" placeholder="山田太郎" value="{{ $user -> name }}">
                </div>

                <div class="mt30">
                    <label for="email">メールアドレス</label>
                </div>
                <div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input type="text" name="email" id="email" placeholder="メールアドレス" value="{{ $user -> email }}">
                </div>

                <div class="btn mt30">
                    @method('PUT')
                    <button class="bk_width">編集</button>
                </div>
        </form>
    </section>
@endsection
