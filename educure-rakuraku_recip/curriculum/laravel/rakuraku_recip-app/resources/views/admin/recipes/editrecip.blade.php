@extends('layouts.app')

@section('title', 'らくらくレシピ')

@section('content')
    <section>
        <form action="{{ route('admin.recipes.update', ['recipe' => $recipe->id]) }}" method="post" enctype="multipart/form-data">
        <h1>レシピ編集</h1>
        @if(session('success'))
        <script>
            alert('{{ session('success') }}');
        </script>
        @endif
            @csrf
            @method('PUT')
            <div class="mt30">
                <label for="title">レシピ名</label>
            </div>
            <div>
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="text" name="title" id="title" placeholder="レシピ名" value="{{ old('title', $recipe->title) }}">
            </div>

            <div class="mt30">
                <label for="ingredients">食材</label>
            </div>
            <div>
                @error('ingredients')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="text" name="ingredients" id="ingredients" placeholder="じゃがいも、ニンジンなど" value="{{ old('ingredients' , $recipe->ingredients) }}">
            </div>

            <div class="mt30">
                <label for="quantity">何人前</label>
            </div>
            <div>
                @error('cooking_time')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <select name="quantity" id="quantity">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" 
                                {{ (old('quantity', $recipe->quantity) == $i) ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="mt30">
                <label for="cooking_time">調理時間（分）</label>
            </div>
            <div>
                @error('cooking_time')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <select name="cooking_time" id="cooking_time">
                    @for ($i = 1; $i <= 60; $i++)
                        <option value="{{ $i }}" 
                                {{ (old('cooking_time', $recipe->cooking_time) == $i) ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="mt30">
                <label for="cook_img">レシピ完成写真<br><span style="font-weight: normal; font-size: 1rem;">※レシピ完成写真は5MB以内</span></label>
            </div>
            <div class="edit-recip">
                @error('cook_img')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                    <input type="file" name="cook_img" id="cook_img" value="{{ old('cook_img' , $recipe->cook_img) }}">
                @if($recipe->cook_img)
                    <img src="{{ asset('storage/' . $recipe->cook_img) }}" alt="Recipe Image" width="300px" class="edit-recip mt30">
                @endif
            </div>

            <div class="mt30">
                <label>レシピ説明</label>
            </div>
            <div>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <textarea name="description" placeholder="材料の説明（食材何グラムなど）と調理方法">{{ old('description' , $recipe->description) }}</textarea>
            </div>

            <div class="btn mt30">
                <button class="bk_width">レシピ編集</button>
            </div>
        </form>

        <div class="link-admin">
            <a href="{{ route('admin.dashboard') }}">管理者画面</a>
        </div>
        
        @foreach($reviews as $review)
            <div class="delet-review">
                <form action="{{ route('reviews.update', $review->id) }}" method="post">
                <h1>レビューの編集・削除</h1>
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                    <div class="rating-input mt30">
                        <label for="rating">評価（星1~5）:</label>
                        @error('rating')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="number" name="rating" value="{{ old('rating' , $review->rating) }}">
                    </div>
                    <div class="comment-input mt10">
                        <label for="comment">コメント:</label>
                        @error('comment')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <textarea name="comment" rows="4" cols="50" maxlength="512">{{ old('comment', $review->comment) }}</textarea>
                    </div>
                    <input type="submit" value="レビューを更新" class="mt10 edit-buttom">
                </form>
                <form class="delet-form" action="{{ route('reviews.destroy', $review->id) }}" onclick="return confirm('本当に削除しますか？')" method="post">
                        @csrf
                        @method('DELETE')
                    <button type="submit">レビューを削除</button>
                </form>
            </div>
        @endforeach
    </section>
@endsection
