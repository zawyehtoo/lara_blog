<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::controller(PageController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/article-detail/{slug}','detail')->name('detail');
    Route::get('/category/{slug}',"categorized")->name('categorized');
});
Route::resource('comment', CommentController::class)->only(['store','update','destroy'])->middleware('auth');

Route::middleware(['auth'])->group(function(){
    Route::resource('blog', BlogController::class);
    Route::resource('photo', PhotoController::class);
    Route::resource('category',CategoryController::class)->middleware('can:viewAny,'.Category::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

