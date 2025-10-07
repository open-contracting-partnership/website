<?php

namespace App\Providers;

use Rareloop\Lumberjack\Facades\Config;
use Rareloop\Lumberjack\Providers\ServiceProvider;

class SEOServiceProvider extends ServiceProvider
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
        // overwrite the yoast og image to use imgix as the domain
        add_filter('wpseo_opengraph_image', function ($image_url) {
            $imgix_host_transforms = Config::get('images.imgix_host_transforms');

            $image_url = str_replace(
                array_keys($imgix_host_transforms),
                array_values($imgix_host_transforms),
                $image_url
            );

            return $image_url;
        });
    }
}
