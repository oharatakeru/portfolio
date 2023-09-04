@extends('layouts.app')

@section('title', 'らくらくレシピ')

@section('content')

    <section>
    <h1>ユーザーリスト</h1>
        <table class="mt30">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><a href="{{ route('admin.users.edit', $user->id) }}">編集</a></td>
                    <td>
                        <form class="form-destroy" action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
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
    