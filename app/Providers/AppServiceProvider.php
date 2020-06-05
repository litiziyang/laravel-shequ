<?php

namespace App\Providers;

use App\Http\Service\UserService;
use App\Service\AuntService;
use App\Service\PostService;
use App\Service\ServiceImp\AuntServiceImp;
use App\Service\ServiceImp\PostServiceImp;
use App\Service\ServiceImp\UserServiceImp;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserService::class, UserServiceImp::class);
        $this->app->bind(PostService::class, PostServiceImp::class);
        $this->app->bind(AuntService::class, AuntServiceImp::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
