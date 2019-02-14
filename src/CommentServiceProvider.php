<?php

namespace Fastup\Comment;

use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'Comment');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
