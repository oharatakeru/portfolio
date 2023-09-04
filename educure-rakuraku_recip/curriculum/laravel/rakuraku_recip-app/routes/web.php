<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\AdminController;

// 管理者ルート
Route::middleware(['auth', 'is.admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users.get');
    Route::post('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users.post');    
});

Route::middleware(['auth'])->group(function () {
    // ログインが必要なページのルート定義
    Route::get('/top', [TopController::class, 'index']);    
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

// トップページルート
Route::get('/top', [TopController::class, 'index'])->name('top');

// 新規登録ルート
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ユーザー編集画面の表示
Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');

// ユーザーのデータの更新
Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');


// 削除
Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');


