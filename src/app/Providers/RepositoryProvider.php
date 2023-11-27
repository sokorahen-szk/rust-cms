<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \Package\Domain\Clan\Repository\IClanRepository::class,
            \Package\Infrastructure\Clan\Repository\ClanRepository::class
        );
        $this->app->bind(
            \Package\Domain\Plyaer\Repository\IPlayerRepository::class,
            \Package\Infrastructure\Plyaer\Repository\PlayerRepository::class
        );
        $this->app->bind(
            \Package\Domain\User\Repository\IUserRepository::class,
            \Package\Infrastructure\User\Repository\UserRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
