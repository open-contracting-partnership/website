<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;
use Timber\Timber;

class AdminServiceProvider extends ServiceProvider
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

		add_action('admin_footer', function() {
			$context = Timber::get_context();
			echo Timber::compile('partials/svg-loader.twig', $context);
		});

    }
}
