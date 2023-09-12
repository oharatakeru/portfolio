<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Review;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{

    public function store(Request $request)
    {

        $userId = auth()->id();

        // バリデーション
        $messages = [
            'rating.required' => '評価は必須です。',
            'rating.integer' => '評価は整数である必要があります。',
            'rating.min' => '評価は1~5の間でお願いします。',
            'rating.max' => '評価は1~5の間でお願いします。',
            'comment.string' => 'コメントは文字列である必要があります。',
            'comment.max' => 'コメントは最大で512文字です。',
            'recipe_id.unique' => 'このレシピには既にレビューを投稿しています。',
        ];
        
        $request->validate([
            'recipe_id' => [
                'required',
                'exists:recipes,id',
                Rule::unique('reviews')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                }),
            ],
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:512'
        ], $messages);
        
        // レビューのインスタンス作成
        $review = new Review;
        $review->recipe_id = $request->recipe_id;
        $review->user_id = auth()->id(); // 現在のログインユーザーのID
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return redirect()->route('recipe.show', ['recipe' => $request->recipe_id])->with('success', 'レビューを保存しました！');
    }

    public function edit(Review $review)
    {
        return view('admin.recipes.editrecip', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $userId = auth()->id();

        // バリデーション
        $messages = [
            'rating.required' => '評価は必須です。',
            'rating.integer' => '評価は整数である必要があります。',
            'rating.min' => '評価は1~5の間でお願いします。',
            'rating.max' => '評価は1~5の間でお願いします。',
            'comment.string' => 'コメントは文字列である必要があります。',
            'comment.max' => 'コメントは最大で512文字です。',
            'recipe_id.unique' => 'このレシピには既にレビューを投稿しています。',
        ];
        
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:512'
        ], $messages);
        
    
        // レビューが存在する場合、内容を更新
        
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();
    
        // レシピの編集ページへリダイレクト
        return redirect()->route('admin.recipes.edit', ['recipe' => $review->recipe_id])->with('success', 'レビューが更新されました。');
    } 
    
    public function destroy(Review $review)
    {
        $recipeId = $review->recipe_id;  // レビューが削除される前にレシピのIDを取得
        $review->delete();
    
        // レシピの編集ページへリダイレクト
        return redirect()->route('admin.recipes.edit', ['recipe' => $recipeId])->with('success', 'レビューが削除されました。');
    }

}
