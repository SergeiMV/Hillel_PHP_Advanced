<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('users.')->prefix('users')->group(function () {
    Route::post('/store', [\App\Http\Controllers\UsersController::class, 'store'])
        ->middleware();
    Route::post('/create', [\App\Http\Controllers\UsersController::class, 'create'])
        ->middleware();
});

Route::name('posts.')->prefix('posts')->group(function () {
    Route::post('/create', [\App\Http\Controllers\PostsController::class, 'create'])
        ->middleware(['token_check']);
    Route::get('/read/{post}', [\App\Http\Controllers\PostsController::class, 'read'])
        ->middleware();
    Route::put('/update/{post}', [\App\Http\Controllers\PostsController::class, 'update'])
        ->middleware(['token_check', 'post_owner_check']);
    Route::delete('/destroy/{post}', [\App\Http\Controllers\PostsController::class, 'destroy'])
        ->middleware(['token_check', 'post_owner_check']);

    Route::post('/{post}/vote', [\App\Http\Controllers\UpvotesController::class, 'vote'])
        ->middleware(['token_check']);
    Route::post('/{post}/unvote', [\App\Http\Controllers\UpvotesController::class, 'unvote'])
        ->middleware(['token_check']);

    Route::name('comments.')->prefix('comments')->group(function () {
        Route::post('/{post}/create', [\App\Http\Controllers\CommentsController::class, 'create'])
            ->middleware(['token_check']);
        Route::get('/read/{comment}', [\App\Http\Controllers\CommentsController::class, 'read'])
            ->middleware();
        Route::put('/update/{comment}', [\App\Http\Controllers\CommentsController::class, 'update'])
            ->middleware(['token_check', 'comment_owner_check']);
        Route::delete('/destroy/{comment}', [\App\Http\Controllers\CommentsController::class, 'destroy'])
            ->middleware(['token_check', 'comment_owner_check']);
    });
});
