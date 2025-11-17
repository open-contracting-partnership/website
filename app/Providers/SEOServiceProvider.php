<?php

namespace App\Providers;

use Imgix\UrlBuilder;
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
        add_filter('wpseo_opengraph_image', function ($imageUrl) {
            $imageUrl = ImgixServiceProvider::processUrl($imageUrl);

            $builder = new UrlBuilder(Config::get('images.imgix_domain'));
            $builder->setSignKey(Config::get('images.imgix_signing_key'));

            return $builder->createURL(parse_url($imageUrl)['path'], []);
        });
    }
}
