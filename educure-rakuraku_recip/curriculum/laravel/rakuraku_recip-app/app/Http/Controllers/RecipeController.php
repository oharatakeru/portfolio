<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    // レシピ追加画面の表示
    public function create() 
    {
        return view('admin.recipes.create');
    }

    // レシピの保存処理
    public function store(Request $request) 
    {
        $recipe = new Recipe;
        $userId = auth()->id();

        $messages = [
            'title.required' => '氏名は必須入力です。',
            'title.max' => '氏名は255字以内でご入力ください。',
            'ingredients.required' => '食材名は必須入力です。',
            'ingredients.max' => '食材名は255字以内でご入力ください。',
            'quantity.required' => '何人前は必須入力です。',
            'quantity.integer' => '半角英数字でご入力ください。',
            'cooking_time.required' => '調理時間は必須入力です。',
            'cooking_time.integer' => '半角英数字でご入力ください。',
            'cook_img.required' => 'レシピ完成写真は必須入力です。',
            'cook_img.max:5000' => 'レシピ完成写真は5MB以内でお願いします。',
            'cook_img.image' => 'jpeg,png,bmp,gif,svg,webp 形式であることを確認してください。',
            'description.required' => 'レシピ説明は必須入力です。',
            'description.max' => 'レシピ説明は512字以内でご入力ください。'
        ];

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'ingredients' => 'required|max:255',
            'quantity' => 'required|integer',
            'description' => 'required|max:512', 
            'cooking_time' => 'required|integer',
            'cook_img' => 'required|image|max:5000'
        ], $messages);

        if ($request->hasFile('cook_img')) {
            // ファイルを保存し、そのファイル名を取得
            $filename = $request->cook_img->store('recipes', 'public');
            $validatedData['cook_img'] = $filename;
        
            // ファイル名をデータベースに保存（この部分は実際のロジックに応じて調整が必要です）
            $recipe->cook_img = $filename;
        }

        $validatedData['user_id'] = auth()->id();
        $recipe->fill($validatedData);
        $recipe->save();
    
        return redirect('/admin/recipes/create')->with('success', 'レシピが追加されました！');
    }
    
    public function index() {
        $recipes = Recipe::all(['id','title', 'ingredients', 'quantity', 'cooking_time']);
        return view('admin.recipes.index', ['recipes' => $recipes]);
    }

    public function edit(Recipe $recipe) {
            return view('admin.recipes.editrecip', ['recipe' => $recipe]);
    }
    
    public function update(Request $request, $id)
    {
        $messages = [
            'title.required' => '氏名は必須入力です。',
            'title.max' => '氏名は255字以内でご入力ください。',
            'ingredients.required' => '食材名は必須入力です。',
            'ingredients.max' => '食材名は255字以内でご入力ください。',
            'quantity.required' => '何人前は必須入力です。',
            'quantity.integer' => '半角英数字でご入力ください。',
            'cooking_time.required' => '調理時間は必須入力です。',
            'cooking_time.integer' => '半角英数字でご入力ください。',
            'cook_img.required' => 'レシピ完成写真は必須入力です。',
            'cook_img.max:5000' => 'レシピ完成写真は5MB以内でお願いします。',
            'cook_img.image' => 'jpeg,png,bmp,gif,svg,webp 形式であることを確認してください。',
            'description.required' => 'レシピ説明は必須入力です。',
            'description.max' => 'レシピ説明は512字以内でご入力ください。'
        ];

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'ingredients' => 'required|max:255',
            'quantity' => 'required|integer',
            'description' => 'required|max:512', 
            'cooking_time' => 'required|integer',
            'cook_img' => 'required|image|max:5000'
        ], $messages);

        $recipe = Recipe::findOrFail($id);

        // 画像がアップロードされた場合の処理
        if ($request->hasFile('cook_img')) {
            // ファイルを保存し、そのファイル名を取得
            $filename = $request->cook_img->store('recipes', 'public');
            $validatedData['cook_img'] = $filename;
        
            // ファイル名をデータベースに保存（この部分は実際のロジックに応じて調整が必要です）
            $recipe->cook_img = $filename;
        }
    
        $recipe->update($validatedData);

        return redirect()->route('admin.recipes.index')->with('success', 'レシピが更新されました！');
    }


    public function destroy(Recipe $recipe) {
        $recipe->delete();
        return redirect()->route('admin.recipes.index')->with('success', 'レシピを削除しました');
    }
    
    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        $reviews = $recipe->reviews;
        return view('recipe.show', compact('recipe' , 'reviews'));
    }

    public function search(Request $request)
    {
        // キーワードの取得
        $keyword = $request->input('keyword');

        // キーワードを使用してレシピを検索
        $recipes = Recipe::where('title', 'LIKE', "%{$keyword}%")
                    ->orWhere('ingredients', 'LIKE', "%{$keyword}%")
                    ->get();

        // 検索結果をビューに渡して表示
        return view('top', ['recipes' => $recipes]);
    }

}
