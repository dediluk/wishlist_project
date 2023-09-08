<?php

namespace App\Providers;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\TrustProxies;
use App\Services\UserService;
use App\Services\UserWishService;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->bind(Request::class, function(Request $request) {
//            dd($request);
//        });
//        $this->app->bind(UserWishService::class, function($app) {
//            dd('ku');
//        });
//        $this->app->bind(UserService::class, function ($app) {
//            return new UserService($app->make(UserWishService::class));
//        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}
