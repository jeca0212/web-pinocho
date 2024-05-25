<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CloudinaryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once __DIR__ . '/../vendor/autoload.php';

        $cloudinary = new Cloudinary(
            [
                'cloud' => [
                    'cloud_name' => 'RestaurantePinocho',
                    'api_key'    => '378321527866639',
                    'api_secret' => 'NT4TPfL4HcauUosk6fUEUYKAoHo',
                ],
            ]
        );

        // Bind the Cloudinary object to the service container
        $this->app->instance('cloudinary', $cloudinary);
    }
    

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
