<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\TurtleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/turtles');

Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    Route::post('/users/{user}/friend', [FriendController::class, 'store'])->name('friends.store');
    Route::delete('/users/{user}/friend', [FriendController::class, 'destroy'])->name('friends.destroy');

    Route::get('/feed', [FeedController::class, 'index'])->name('feed');

    Route::post('/turtles/{turtle}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::post('/turtles/{id}/restore', [TurtleController::class, 'restore'])->name('turtles.restore');
    Route::delete('/turtles/{id}/force', [TurtleController::class, 'forceDelete'])->name('turtles.force-delete');

    Route::resource('turtles', TurtleController::class)->withTrashed(['show']);
});
