<?php

namespace khyrie\Formset;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__.'/../config/formset.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('formset.php'),
        ], 'config');

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'formset');
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'formset'
        );

        $this->app->bind('formset', function () {
            return new Formset();
        });

        $this->app->bind('fieldset', function () {
            return new Fieldset();
        });
    }
}
