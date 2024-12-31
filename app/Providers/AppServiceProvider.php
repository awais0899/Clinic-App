<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the custom role validation rule
        Validator::extend('role', function ($attribute, $value, $parameters, $validator) {
            // Define valid roles (adjust this array based on your application's roles)
            $validRoles = ['therapist', 'owner', 'patient']; 

            // Check if the value is a valid role
            return in_array($value, $validRoles);
        });
    }
}
