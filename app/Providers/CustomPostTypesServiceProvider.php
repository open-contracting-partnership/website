<?php

namespace App\Providers;

use Rareloop\Lumberjack\Config;
use Rareloop\Lumberjack\Providers\CustomPostTypesServiceProvider as BaseCustomPostTypesServiceProvider;

class CustomPostTypesServiceProvider extends BaseCustomPostTypesServiceProvider
{
    /**
     * Register the post types at init, as their labels load translations.
     */
    public function boot(Config $config)
    {
        add_action('init', fn() => parent::boot($config), 0);
    }
}
