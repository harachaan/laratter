<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'auth'], function(){
    // ここに書いたものはログインしないと使えなくなる？
    // コメント機能をつけたい
    Route::get('tweet/{tweet}/{user}/comment/create', [CommentController::class, 'create'])->name('comment.create');
    Route::post('tweet/{tweet}/{user}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('tweet/{tweet}/{user}/comment', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::get('tweet/{tweet}/comment', [CommentController::class, 'index'])->name('comment.index');
    // コメントはtweet詳細画面に表示させたい 
    // Route::get('tweet/{tweet}/comment', [CommentController::class, 'show'])->name('comment.show');
    
    Route::post('user/{user}/follow', [FollowController::class, 'store'])->name('follow');
    Route::post('user/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');

    Route::post('tweet/{tweet}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('tweet/{tweet}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');

    Route::get('/tweet/mypage', [TweetController::class, 'mydata'])->name('tweet.mypage');
    // ユーザページの作成
    Route::get('user/{user}', [FollowController::class, 'show'])->name('follow.show');
    // timeline
    Route::get('/tweet/timeline', [TweetController::class, 'timeline'])->name('tweet.timeline');
    // 検索画面
    Route::get('/tweet/search/input', [SearchController::class, 'create'])->name('search.input');
    // 検索処理
    Route::get('/tweet/search/result', [SearchController::class, 'index'])->name('search.result');
    // resourceは一番下に持ってくる！tweetのルートに反映される前に/tweetのurlに飛んじゃうから．．
    Route::resource('tweet', TweetController::class);
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
