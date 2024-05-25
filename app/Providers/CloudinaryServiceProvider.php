<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class CloudinaryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once base_path() . '/vendor/autoload.php';

        $config = Configuration::instance([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        $cloudinary = new Cloudinary($config);

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