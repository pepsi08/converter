<?php

namespace Ivanchenko\Converter;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Validator;

class ConverterServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
        Validator::extend('equal_currency', function ($attribute, $value, $parameters, $validator) {
            return $value != $validator->getData()['source_currency'];
        });

        $this->loadViewsFrom(__DIR__ . '/resources/view', 'converter');

        $this->publishes([
            __DIR__ . '/resources/view' => resource_path('views/vendor/converter'),
        ]);

        $this->publishes([
            __DIR__ . '/js' => public_path('vendor/converter'),
        ], 'public');

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }
//        include __DIR__.'/Http/routes.php';
        $this->app->make('Ivanchenko\Converter\Http\Controllers\CurrencyController');
    }

}