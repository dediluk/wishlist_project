<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
//    \Illuminate\Support\Facades\Notification::send(\App\Models\User::find(11), new \App\Notifications\UsersNewWishNotification());
    return view('welcome');
})->name('index');

Route::middleware(['auth'])->group(function() {
    //
});

Route::middleware(['auth'])->group(function() {
    Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('users.logout')->middleware('auth');
    Route::get('users/{subscribed_user_id}/subscribe', [\App\Http\Controllers\UserController::class, 'subscribe'])->name('users.subscribe');
    Route::get('/users/{user_id}/reservation/{wish_id}', [\App\Http\Controllers\UserWishController::class, 'reserve'])
        ->name('user_wish.reservation');
    Route::get('users/{subscribed_user_id}/subscribe', [\App\Http\Controllers\UserController::class, 'subscribe'])->name('users.subscribe');
    Route::get('users/{subscribed_user_id}/unsubscribe', [\App\Http\Controllers\UserController::class, 'unsubscribe'])->name('users.unsubscribe');
    Route::get('/wishes/{wish_id}/wished', [\App\Http\Controllers\UserWishController::class, 'wished'])
        ->name('user_wish.wished');
    Route::resource('/users', \App\Http\Controllers\UserController::class);
    Route::resource('/wishes', \App\Http\Controllers\WishController::class);
});
Route::resource('/users', \App\Http\Controllers\UserController::class)->only(['index', 'show', 'create']);
Route::resource('/wishes', \App\Http\Controllers\WishController::class)->only(['index', 'show']);
Route::get('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('users.login');
Route::post('/users/authenticate', [\App\Http\Controllers\UserController::class, 'authenticate'])->name('users.authenticate');



//Route::resource('/users', \App\Http\Controllers\UserController::class);
//Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('users.logout');
//Route::post('/user/authenticate', [\App\Http\Controllers\UserController::class, 'authenticate'])->name('users.authenticate');

//Route::get('/users/{user_id}/reservation/{wish_id}', [\App\Http\Controllers\UserWishController::class, 'reserve'])
//    ->name('user_wish.reservation');
//Route::get('users/{subscribed_user_id}/subscribe', [\App\Http\Controllers\UserController::class, 'subscribe'])->name('users.subscribe');
//Route::get('users/{subscribed_user_id}/unsubscribe', [\App\Http\Controllers\UserController::class, 'unsubscribe'])->name('users.unsubscribe');
//Route::get('/wishes/{wish_id}/wished', [\App\Http\Controllers\UserWishController::class, 'wished'])
//    ->name('user_wish.wished');
