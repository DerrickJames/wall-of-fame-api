<?php

namespace Fame\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * return void
     */
    public function register()
    {
        $this->app->singleton(
            'Fame\Repositories\UserInterface',
            'Fame\Repositories\Eloquent\UserRepository'
        );
    }
}
