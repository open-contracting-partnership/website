<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any app specific items into the container
     */
    public function register(): void
    {
    }

    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        add_filter('upload_mimes', function ($mimes) {
            $mimes['svg'] = 'image/svg+xml';
            return $mimes;
        });
    }
}
