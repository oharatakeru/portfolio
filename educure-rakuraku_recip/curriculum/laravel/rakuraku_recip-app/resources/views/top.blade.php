@extends('layouts.app')

@section('title', 'らくらくレシピ')

@section('content')
    <section>
        <h1>レシピ一覧</h1>
        <div class="grid-2-2 mt30">
            @foreach($recipes as $recipe)
                <div class="recip-item">
                    <a href="{{ route('recipe.show', ['recipe' => $recipe->id]) }}">
                    <div class="recip-title">
                        <p>{{ $recipe->title }}</p>
                        <img src="{{ asset('storage/' . $recipe->cook_img) }}" alt="レシピ画像" width="100%">
                    </div></a>
                    <div class="recip-description mt20">
                    <p>平均評価: 
                        @for($i = 1; $i <= round($recipe->averageRating()); $i++)
                            ★
                        @endfor
                        @for($i = round($recipe->averageRating()) + 1; $i <= 5; $i++)
                            ☆
                        @endfor
                    </p>
                        <p>レシピ説明</p>
                        <p>{{ $recipe->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
