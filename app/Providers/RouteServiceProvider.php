<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));

            Route::prefix('api/crud')
                ->as('crud.')
                ->middleware(['api', 'auth:sanctum'])
                ->group(base_path('routes/crud.php'));

            Route::prefix('api/payment')
                ->as('payment.')
                ->group(base_path('routes/payment.php'));

            Route::prefix('api/front')
                ->as('front.')
                ->group(base_path('routes/front.php'));

            Route::prefix('api/auth')
                ->as('auth.')
                ->middleware('api')
                ->group(base_path('routes/auth.php'));

            Route::prefix('api/file')
                ->as('file.')
                ->group(base_path('routes/file-management.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
