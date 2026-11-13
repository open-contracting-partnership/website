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
        // The posts archive lists every post client-side, and .htaccess redirects its /page/N/ URLs
        // back to page 1, so advertising pagination loops anything that follows rel="next".
        $hideOnPostsArchive = fn ($link) => is_home() ? false : $link;

        add_filter('wpseo_next_rel_link', $hideOnPostsArchive);
        add_filter('wpseo_prev_rel_link', $hideOnPostsArchive);

        // overwrite the yoast og image to use imgix as the domain
        add_filter('wpseo_opengraph_image', function ($imageUrl) {
            $imageUrl = ImgixServiceProvider::processUrl($imageUrl);

            $builder = new UrlBuilder(Config::get('images.imgix_domain'));
            $builder->setSignKey(Config::get('images.imgix_signing_key'));

            return $builder->createURL(parse_url($imageUrl)['path'], []);
        });
    }
}
