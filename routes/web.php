<?php

use App\Events\MyEvent;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::middleware(['isAdmin'])->group(function () {
    Route::resource('/wishes', \App\Http\Controllers\WishController::class)->only(['destroy']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/payment', [\App\Http\Controllers\PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment', [\App\Http\Controllers\PaymentController::class, 'payment'])->name('payment.payment');

    Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('users.logout')->middleware('auth');

    Route::get('/users/{user_id}/reservation/{wish_id}', [\App\Http\Controllers\UserWishController::class, 'reserved'])
        ->name('user_wish.reservation')
        ->missing(function(Request $request) {
            dd('test');
        });
    Route::get('/users/{userId}/unreservation/{wishId}', [\App\Http\Controllers\UserWishController::class, 'unreservation'])
        ->name('user_wish.unreservation');
    Route::get('users/{subscribed_user_id}/subscribe', [\App\Http\Controllers\UserController::class, 'subscribe'])->name('users.subscribe');
    Route::get('users/{subscribed_user_id}/unsubscribe', [\App\Http\Controllers\UserController::class, 'unsubscribe'])->name('users.unsubscribe');

    Route::get('/wishes/{wish_id}/wished', [\App\Http\Controllers\UserWishController::class, 'wished'])
        ->name('user_wish.wished');
    Route::get('/wishes/{wish_id}/unwish', [\App\Http\Controllers\UserWishController::class, 'unwish'])
        ->name('user_wish.unwish');

    Route::resource('/users', \App\Http\Controllers\UserController::class);
    Route::resource('/wishes', \App\Http\Controllers\WishController::class)->except(['destroy']);

    Route::get('/subscriptions', [\App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions.index');
});
Route::resource('/users', \App\Http\Controllers\UserController::class)->only(['index', 'show', 'create', 'store']);
Route::post('/users/{id}/changeRole', [\App\Http\Controllers\UserController::class, 'changeRole'])->name('users.change_role')->middleware('isAdmin');
Route::post('/users/authenticate', [\App\Http\Controllers\UserController::class, 'authenticate'])->name('users.authenticate');


Route::resource('/wishes', \App\Http\Controllers\WishController::class)->only(['index', 'show']);

Route::get('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('users.login');

Route::post('/search', [\App\Http\Controllers\SearchController::class, 'search'])->name('search');

Route::fallback(function () {
    dd('fallback');
});

Route::get('/test', function () {
   return 'response';
});

//Route::resource('/users', \App\Http\Controllers\UserController::class);
//Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('users.logout');
//Route::post('/user/authenticate', [\App\Http\Controllers\UserController::class, 'authenticate'])->name('users.authenticate');

//Route::get('/users/{user_id}/reservation/{wish_id}', [\App\Http\Controllers\UserWishController::class, 'reserve'])
//    ->name('user_wish.reservation');
//Route::get('users/{subscribed_user_id}/subscribe', [\App\Http\Controllers\UserController::class, 'subscribe'])->name('users.subscribe');
//Route::get('users/{subscribed_user_id}/unsubscribe', [\App\Http\Controllers\UserController::class, 'unsubscribe'])->name('users.unsubscribe');
//Route::get('/wishes/{wish_id}/wished', [\App\Http\Controllers\UserWishController::class, 'wished'])
//    ->name('user_wish.wished');
