<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Wiki\PageInterface',
            'App\Wiki\PageRepository'
        );
        
        $this->app->bind(
            'App\Wiki\ImageInterface',
            'App\Wiki\ImageRepository'
        );

    }
}
