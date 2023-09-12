<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ReviewController;

// 管理者ルート
Route::middleware(['auth', 'is.admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users.get');
    Route::post('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users.post');   
    Route::get('/admin/recipes/create', [RecipeController::class, 'create'])->name('admin.recipes.create');
    Route::get('/admin/recipes/index', [RecipeController::class, 'index'])->name('admin.recipes.index');
    Route::get('/admin/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('admin.recipes.edit');
});

Route::middleware(['auth'])->group(function () {
    // ログインが必要なページのルート定義
    Route::get('/top', [TopController::class, 'index']);    
    Route::get('/recipe/{recipe}', [RecipeController::class, 'show'])->name('recipe.show');
    // ユーザー編集画面の表示
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    // トップページルート
    Route::get('/top', [TopController::class, 'index'])->name('top');
});

// ログインルート
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
// ログアウトルート
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 表示ルート
Route::get('/', function () {
    return redirect('/login');
});


// 新規登録ルート
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ユーザーのデータの更新
Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');

// 削除
Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

// レシピの保存処理
Route::post('/admin/recipes/store', [RecipeController::class, 'store'])->name('admin.recipes.store');

// レシピ削除
Route::delete('/admin/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('admin.recipes.destroy');

// レシピ編集
Route::put('/admin/recipes/{recipe}', [RecipeController::class, 'update'])->name('admin.recipes.update');

// レシピ検索
Route::post('/recipe/search', [RecipeController::class, 'search'])->name('recipe.search');

// レビュー
Route::post('/recipe/{recipe}', [ReviewController::class, 'store'])->name('review.store')->middleware('auth');

Route::resource('reviews', ReviewController::class)->only(['edit', 'update', 'destroy']);