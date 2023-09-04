<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title', 'デフォルトのタイトル')</title>
</head>
<body>
    @if(Auth::check())
        @include('layouts.header_login')
    @else
        @include('layouts.header_top')
    @endif

    @yield('content')

</body>
</html>
