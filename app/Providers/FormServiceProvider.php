<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register any app specific items into the container
     */
    public function register()
    {
    }

    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        $this->disableCSS();
    }

    protected function disableCSS()
    {
        add_filter('gform_disable_css', '__return_true');
        add_filter('gform_disable_form_theme_css', '__return_true');
    }
}
