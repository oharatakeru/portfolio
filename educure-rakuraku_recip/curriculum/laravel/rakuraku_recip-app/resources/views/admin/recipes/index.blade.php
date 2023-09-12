@extends('layouts.app')

@section('title', 'らくらくレシピ')

@section('content')
    <section>
        <h1>レシピ一覧</h1>
        
        <table class="mt30">
            <thead>
                <tr>
                    <th>レシピ名</th>
                    <th>食材</th>
                    <th>何人前</th>
                    <th>調理時間</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($recipes as $recipe)
                    <tr>
                        <td>{{ $recipe->title }}</td>
                        <td>{{ $recipe->ingredients }}</td>
                        <td>{{ $recipe->quantity }}</td>
                        <td>{{ $recipe->cooking_time }}</td>
                        <td><a href="{{ route('admin.recipes.edit', $recipe) }}">編集</a></td>
                        <td>
                            <form class="form-destroy" action="{{ route('admin.recipes.destroy', $recipe) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="link-admin">
            <a href="{{ route('admin.dashboard') }}">管理者画面</a>
        </div>
    </section>
@endsection
