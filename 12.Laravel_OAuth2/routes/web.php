<?php

use App\Models\Ad;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\AdController::class, 'index'], function () {
})->name('home');

Route::get('/callback', [\App\Http\Controllers\RedditController::class, 'callback'])
    ->middleware('guest');

Route::name('ads.')->prefix('ads')->group(function () {
    Route::post('/create', [\App\Http\Controllers\AdController::class, 'create'])
        ->middleware('auth')
        ->name('create');

    Route::get('/edit/{ad?}', [\App\Http\Controllers\AdController::class, 'edit'])
        ->middleware(['auth', 'edit-ad'])
        ->name('edit');

    Route::put('/{ad}', [\App\Http\Controllers\AdController::class, 'update'])
        ->middleware(['auth', 'edit-ad'])
        ->name('update');

    Route::delete('/{ad}', [\App\Http\Controllers\AdController::class, 'destroy'])
        ->middleware(['auth', 'edit-ad'])
        ->name('destroy');

    Route::get('/{ad}', [\App\Http\Controllers\AdController::class, 'show'])->name('show');
});

Route::name('users.')->prefix('users')->group(function () {
    Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])
        ->middleware('guest')
        ->name('login');

    Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');
});
