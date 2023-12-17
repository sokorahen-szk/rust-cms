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
            \Package\Domain\Player\Repository\IPlayerRepository::class,
            \Package\Infrastructure\Player\Repository\PlayerRepository::class
        );
        $this->app->bind(
            \Package\Domain\User\Repository\IUserRepository::class,
            \Package\Infrastructure\User\Repository\UserRepository::class
        );
        $this->app->bind(
            \Package\Domain\User\Repository\IRoleRepository::class,
            \Package\Infrastructure\User\Repository\RoleRepository::class
        );
        $this->app->bind(
            \Package\Domain\User\Repository\IUserEmailVerifyTokenRepository::class,
            \Package\Infrastructure\User\Repository\UserEmailVerifyTokenRepository::class
        );
        $this->app->bind(
            \Package\Domain\Tag\Repository\ITagRepository::class,
            \Package\Infrastructure\Tag\Repository\TagRepository::class
        );
        $this->app->bind(
            \Package\Domain\User\Repository\IUserPostRepository::class,
            \Package\Infrastructure\User\Repository\UserPostRepository::class
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
