@extends('layouts.app')

@section('title', 'らくらくレシピ')

@section('content')

    <section>
        <h1>管理者画面</h1>
        <div class="admin-item">
            <form class="admin" action="{{route('admin.recipes.index')}}" method="get">
                <button type="submit">レシピ一覧</button>
            </form>
        </div>
        <div class="admin-item">
            <form class="admin" action="{{route('admin.users.post')}}" method="post">
                @csrf
                <button type="submit">ユーザー一覧</button>
            </form>
        </div>
        <div class="admin-item">
            <form class="admin" action="{{route('admin.recipes.create')}}" method="get">
                <button type="submit">レシピ追加</button>
            </form>
        </div>
    </section>

@endsection
    