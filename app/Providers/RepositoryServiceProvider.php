<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    CallRepositoryInterface,
};
use App\Repositories\{
    CallRepository
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
    }

    public function boot()
    {

    }
}
