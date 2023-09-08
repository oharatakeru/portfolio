@extends('layouts.app')

@section('title', 'らくらくレシピ')

@section('content')
    <div class="recip-show">
        <h1 class="mt30">{{ $recipe->title }}</h1>
        <div class="recip-flex mt30">
            <img src="{{ asset('storage/' . $recipe->cook_img) }}" alt="レシピ画像">
            <p>{{ $recipe->quantity }}人前<br>調理時間：{{ $recipe->cooking_time }}分<br>食材：{{ $recipe->ingredients }}</p>
        </div>
        <p class="mt30">レシピ説明<br>{{ $recipe->description }}</p>
    </div>

    <div class="reviews mt30">
        <h2>レビュー一覧</h2>
        @foreach($reviews as $review)
            <div class="review mt30">
                <p>レビュワー：{{ $review->user->name }}  <span class="review-date">{{ $review->created_at->format('Y-m-d') }}</span></p>
                <p>評価：
                @for($i = 0; $i < $review->rating; $i++)
                    ★
                @endfor
                @for($i = $review->rating; $i < 5; $i++)
                    ☆
                @endfor
                </p>
                <p>コメント：{{ $review->comment }}</p>
            </div>
        @endforeach
    </div>

    <div class="review-form mt30">
        <form action="{{ route('review.store', ['recipe' => $recipe->id]) }}" method="post">
        <h2>レビューを書く</h2>
            @csrf
            <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
            <div class="rating-input mt30">
                <label for="rating">評価（星1~5）:</label>
                <input type="number" name="rating" min="1" max="5" required>
            </div>
            <div class="comment-input mt10">
                <label for="comment">コメント:</label>
                <textarea name="comment" rows="4" cols="50" maxlength="512"></textarea>
            </div>
            <input type="submit" value="レビューを送信" class="mt10">
        </form>
    </div>
@endsection
