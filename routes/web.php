<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\IdeaController as AdminIdeaController;
use Illuminate\Support\Facades\Route;

Route::get('lang/{lang}', function ($lang) {
    app()->setLocale($lang);
    session()->put('locale', $lang);

    return redirect()->route('dashboard');
})->name('lang');

//* Main page
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Route::resource('ideas', IdeaController::class)->except(['index', 'create', 'show'])->middleware('auth');
Route::resource('ideas', IdeaController::class)->only(['show']);
Route::resource('ideas.comment', CommentController::class)->only(['store'])->middleware('auth');
Route::resource('users', ProfileController::class)->only(['edit', 'update'])->middleware('auth');
Route::resource('users', ProfileController::class)->only(['show']);

Route::get('profile', [ProfileController::class, 'profile'])->name('profile')->middleware('auth');

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->name('users.follow')->middleware('auth');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow')->middleware('auth');

Route::post('ideas/{idea}/like', [IdeaLikeController::class, 'like'])->name('ideas.like')->middleware('auth');
Route::post('ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])->name('ideas.unlike')->middleware('auth');

Route::get('/feed', FeedController::class)->name('feed')->middleware('auth');


Route::get('/terms', function () {
    return view('terms');
})->name('terms');


Route::middleware(['auth', 'can:admin'])->prefix('/admin')->as('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->only('index', 'destroy');
    Route::resource('ideas', AdminIdeaController::class)->only('index', 'destroy');
    Route::resource('comments', AdminCommentController::class)->only('index', 'destroy');
});
