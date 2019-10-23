<?php

namespace App\Providers;

use Rareloop\Lumberjack\Facades\Config;
use Rareloop\Lumberjack\Providers\ServiceProvider;
use Timber\Timber;

class ImgixServiceProvider extends ServiceProvider
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

		add_filter('timber/twig', function(\Twig_Environment $twig) {
		    $twig->addFunction(new \Twig\TwigFunction('imgix', [$this, 'render']));
		    return $twig;
		});

    }

	public function render($args) {

		$this->prepareParams($args);

		$image = [
			'src' => $this->buildURL($args, $args['transforms'][0]),
			'srcset' => $this->buildSources($args),
			'sizes' => $args['sizes'],
			'alt' => $args['alt']
		];

		return Timber::compile('partials/imgix.twig', $image);

	}

	private function prepareParams(&$args) {

		// make sure the host is set within the params
		$args = array_merge([
			'host' => Config::get('images.imgix_base_url'),
			'alt' => ''
		], $args);

		// ensure the src url is stripped of it's domain
		$args['src'] = parse_url($args['src'])['path'];

	}

	private function buildSources($args) {

		$srcset = array_map(function($transform) use ($args) {
			return $this->buildURL($args, $transform) . ' ' . $transform['w'] . 'w';
		}, $args['transforms']);

		return implode(', ', $srcset);

	}

	private function buildURL($args, $transform) {

		$transform = array_merge($args['params'], $transform);

		unset($transform['host']);

		if ( isset($args['aspect_ratio']) && $args['aspect_ratio'] && $transform['w'] ) {
			$transform['h'] = ceil($transform['w'] / ($args['aspect_ratio'][0] / $args['aspect_ratio'][1]));
		}

		return $args['host'] . '/' . $args['src'] . '?' . http_build_query($transform);

	}

}
