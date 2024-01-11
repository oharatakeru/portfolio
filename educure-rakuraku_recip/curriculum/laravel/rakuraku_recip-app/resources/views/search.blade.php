@extends('layouts.app')

@section('title', 'らくらくレシピ')

@section('content')
    <section>
        <h1>レシピ一覧</h1>
        <div class="grid-2-2 mt30">
            @foreach($recipes as $recipe)
                <div class="recip-item">
                    <a href="{{ $recipe['recipeUrl'] }}">
                        <div class="recip-title">
                            <p>{{ $recipe['recipeTitle'] }}</p>
                            <img src="{{ $recipe['foodImageUrl'] }}" alt="レシピ画像" width="100%">
                        </div>
                    </a>
                    <div class="recip-description mt20">
                        <p>投稿者: {{ $recipe['nickname'] }}</p>
                        <p>説明: {{ $recipe['recipeDescription'] }}</p>
                        <p>材料:</p>
                        <ul>
                        @foreach($recipe['recipeMaterial'] as $material)
                            <li>{{ $material }}</li>
                        @endforeach
                        </ul>
                        <p>調理時間: {{ $recipe['recipeIndication'] }}</p>
                        <p>公開日: {{ $recipe['recipePublishday'] }}</p>
                        <p>ランキング: {{ $recipe['rank'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
