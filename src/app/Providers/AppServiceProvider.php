<?php

namespace App\Providers;

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
        $this->app->bind(
            \Package\Usecase\Clan\IClanInteractor::class,
            \Package\Usecase\Clan\ClanInteractor::class
        );
        $this->app->bind(
            \Package\Usecase\User\IUserInteractor::class,
            \Package\Usecase\User\UserInteractor::class
        );
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
