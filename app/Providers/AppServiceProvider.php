<?php

namespace App\Providers;

use Rareloop\Lumberjack\Page;
use Rareloop\Lumberjack\Post;
use Rareloop\Lumberjack\Providers\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any app specific items into the container
     */
    public function register(): void
    {
        add_filter('timber/post/classmap', fn($classmap) => [
            ...$classmap,
            Post::getPostType() => Post::class,
            Page::getPostType() => Page::class,
        ]);
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
