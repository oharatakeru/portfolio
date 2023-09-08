@extends('layouts.app')

@section('title', 'らくらくレシピ')

@section('content')
    <section>
        <form action="{{ route('admin.recipes.store') }}" method="post" enctype="multipart/form-data">
        <h1>レシピ追加</h1>
            @if(session('success'))
                <div class="alert mt30">
                    {{ session('success') }}
                </div>
            @endif
            @csrf
            <div class="mt30">
                <label for="title">レシピ名</label>
            </div>
            <div>
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="text" name="title" id="title" placeholder="レシピ名" value="{{ old('title') }}">
            </div>

            <div class="mt30">
                <label for="ingredients">食材</label>
            </div>
            <div>
                @error('ingredients')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="text" name="ingredients" id="ingredients" placeholder="じゃがいも、ニンジンなど" value="{{ old('ingredients') }}">
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
                        <option value="{{ $i }}" {{ old('cooking_time') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="mt30">
                <label for="cooking_time">調理時間(分)</label>
            </div>
            <div>
                @error('cooking_time')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <select name="cooking_time" id="cooking_time">
                    @for ($i = 1; $i <= 60; $i++)
                        <option value="{{ $i }}" {{ old('cooking_time') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="mt30">
                <label for="cook_img">レシピ完成写真<br><span style="font-weight: normal; font-size: 1rem;">※レシピ完成写真は5MB以内</span></label>
            </div>
            <div>
                @error('cook_img')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="file" name="cook_img" id="cook_img" value="{{ old('cook_img') }}">
            </div>

            <div class="mt30">
                <label>レシピ説明</label>
            </div>
            <div>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <textarea name="description" placeholder="材料の説明（食材何グラムなど）と調理方法">{{ old('description') }}</textarea>
            </div>

            <div class="btn mt30">
                <button class="bk_width">レシピ追加</button>
            </div>
        </form>
    </section>
@endsection
