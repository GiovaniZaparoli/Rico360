<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    CallRepositoryInterface,
    UserRepositoryInterface,
    TwilioRepositoryInterface,
};
use App\Repositories\{
    CallRepository,
    UserRepository,
    TwilioRepository,
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

        $this->app->bind(
            TwilioRepositoryInterface::class,
            TwilioRepository::class,
        );
    }

    public function boot()
    {

    }
}
