<?php

namespace App\Providers;

use Rareloop\Lumberjack\Facades\Config;
use Rareloop\Lumberjack\Providers\ServiceProvider;

class SEOServiceProvider extends ServiceProvider
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

		// overwrite the yoast og image to use imgix as the domain
		add_filter('wpseo_opengraph_image', function($image_url) {

			$imgix_url = Config::get('images.imgix_base_url');

			// don't continue if we don't have an imgix url set
			if ( ! $imgix_url ) {
				return $image_url;
			}

			$image_parts = parse_url($image_url);

			return trim($imgix_url, '/') . $image_parts['path'];

		});

	}
}
