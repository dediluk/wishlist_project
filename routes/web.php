<?php

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
    return view('welcome');
})->name('index');

Route::resource('/wishes', \App\Http\Controllers\WishController::class);
Route::resource('/users', \App\Http\Controllers\UserController::class);
Route::get('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('users.login');
Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('users.logout');
Route::post('/user/authenticate', [\App\Http\Controllers\UserController::class, 'authenticate'])->name('users.authenticate');

Route::get('/users/{user_id}/reservation/{wish_id}', [\App\Http\Controllers\UserWishController::class, 'reserve'])
    ->name('user_wish.reservation');
Route::get('/wishes/{wish_id}/wished', [\App\Http\Controllers\UserWishController::class, 'wished'])
    ->name('user_wish.wished');
