<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api') // API prefix (optional)
                 ->middleware('api') // API middleware (optional)
                 ->namespace($this->namespace) // Namespace for controllers (optional)
                 ->group(base_path('routes/api.php')); // Path to the api.php file

            Route::middleware('web')
                 ->group(base_path('routes/web.php')); // Path to the web.php file
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        // You can configure rate limiters here if needed
    }
}
