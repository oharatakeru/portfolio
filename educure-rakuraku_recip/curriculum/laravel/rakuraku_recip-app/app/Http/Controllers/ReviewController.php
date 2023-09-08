<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:512'
        ]);

        // レビューのインスタンス作成
        $review = new Review;
        $review->recipe_id = $request->recipe_id;
        $review->user_id = auth()->id(); // 現在のログインユーザーのID
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return redirect()->route('recipe.show', ['recipe' => $request->recipe_id])->with('success', 'レビューを保存しました！');
    }
}
