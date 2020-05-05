<?php
namespace Parallax\ObserveRelationship;

use Illuminate\Support\ServiceProvider;

class ObserveRelationshipProvider extends ServiceProvider
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

        if ($models = config('observe-relationship.models')) {
            foreach ($models as $watch => $triggers) {
                $watch::saved(function($model) use ($triggers) {
                    foreach ($triggers as $trigger) {
                        $instances = $trigger['model']::where($trigger['field'], $model->id)->get();
                        if ($instances->count() > 0) {
                            foreach ($instances as $instance) {
                                $instance->updated_at = now();
                                $instance->save();
                            }
                        }
                    }
                });
            }
        }
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
