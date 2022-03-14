<?php

namespace App\Providers;

use App\Http\Routing\ApiResourceRegister;
use Illuminate\Routing\ResourceRegistrar;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $register = new ApiResourceRegister($this->app['router']);
        $this->app->bind(ResourceRegistrar::class, static function () use ($register) {
            return $register;
        });
    }
}
