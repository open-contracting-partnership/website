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
        add_filter('timber/twig', function (\Twig_Environment $twig) {
            $twig->addFunction(new \Twig\TwigFunction('imgix', [$this, 'render']));
            return $twig;
        });
    }

    public function render($args)
    {
        $this->prepareParams($args);

        $image = [
            'src' => $this->buildURL($args),
            'class' => $args['class'] ?? '',
            'srcset' => $this->buildSources($args),
            'sizes' => $args['sizes'] ?? '',
            'alt' => $args['alt'],
            'width' => $args['aspect_ratio'] ? $args['aspect_ratio'][0] : null,
            'height' => $args['aspect_ratio'] ? $args['aspect_ratio'][1] : null,
            'loading' => $args['loading']
        ];

        return Timber::compile('partials/imgix.twig', $image);
    }

    private function prepareParams(&$args)
    {

        // make sure the host is set within the params
        $args = array_merge([
            'host_transforms' => Config::get('images.imgix_host_transforms'),
            'alt' => '',
            'aspect_ratio' => null,
            'loading' => 'lazy'
        ], $args);
    }

    private function buildSources($args)
    {
        $srcset = array_map(function ($transform) use ($args) {
            return $this->buildURL($args, $transform) . ' ' . $transform['w'] . 'w';
        }, $args['transforms'] ?? []);

        return implode(', ', $srcset);
    }

    private function buildURL($args, $transform = null)
    {
        if ($transform === null && isset($args['transforms'][0])) {
            $transform = $args['transforms'][0];
        }

        if ($transform) {
            $transform = array_merge($args['params'], $transform);
        } else {
            $transform = $args['params'];
        }

        unset($transform['host']);

        if (
            isset($args['aspect_ratio'])
            && $args['aspect_ratio']
            && isset($transform['w'])
            && $transform['w']
        ) {
            $transform['h'] = ceil($transform['w'] / ($args['aspect_ratio'][0] / $args['aspect_ratio'][1]));
        }

        $args['src'] = str_replace(
            array_keys($args['host_transforms']),
            array_values($args['host_transforms']),
            $args['src']
        );

        return $args['src'] . '?' . http_build_query($transform);
    }
}
