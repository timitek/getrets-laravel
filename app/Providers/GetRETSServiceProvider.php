<?php

namespace Timitek\GetRETS\Providers;

use App;
use Config;
use Illuminate\Support\ServiceProvider;
use Lang;
use Timitek\GetRETS\GetRETS;

class GetRETSServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('getrets', function ($app) {
            return new GetRETS(config('getrets.customer_key'));
        });

    }

    /**
     * Register routes, translations, views and publishers.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(realpath(__DIR__.'/../../routes/web.php'));

        $this->loadTranslationsFrom(realpath(__DIR__.'/../../resources/lang'), 'GetRETS');
        $this->publishes([realpath(__DIR__.'/../../resources/lang') => resource_path('lang/vendor/timitek')], 'translations');

        $this->loadViewsFrom(realpath(__DIR__.'/../../resources/views'), 'GetRETS');
        $this->publishes([realpath(__DIR__.'/../../resources/views') => base_path('resources/views/vendor/timitek/getrets')], 'views');

        $this->loadMigrationsFrom(realpath(__DIR__.'/../../database/migrations'));
        $this->publishes([realpath(__DIR__.'/../../database/migrations') => database_path('migrations')], 'migrations');

        $this->publishes([realpath(__DIR__.'/../../resources/assets') => public_path('assets')], 'public');

        $this->publishes([realpath(__DIR__.'/../../config') => config_path('')], 'config');

        $this->publishes([realpath(__DIR__.'/../../database/seeds') => database_path('seeds')], 'seeds');
    }
}
