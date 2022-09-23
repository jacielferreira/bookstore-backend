<?php

namespace App\Providers;

use App\Interfaces\BookRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\BookRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            BookRepositoryInterface::class, BookRepository::class,
        );

        $this->app->bind(
            UserRepositoryInterface::class, UserRepository::class,
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
