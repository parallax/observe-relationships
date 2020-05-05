<?php
namespace Parallax\AlgoliaRelationship;

use Illuminate\Support\ServiceProvider;

class AlgoliaRelationshipProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/' => config_path(),
        ], 'static.config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
