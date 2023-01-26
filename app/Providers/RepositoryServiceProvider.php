<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    CallRepositoryInterface,
    UserRepositoryInterface,
};
use App\Repositories\{
    CallRepository,
    UserRepository,
};

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CallRepositoryInterface::class,
            CallRepository::class,
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class,
        );
    }

    public function boot()
    {

    }
}
