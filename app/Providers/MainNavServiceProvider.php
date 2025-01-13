<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;
use Timber\Timber;
use Timber\Menu;
use Timber\Image;

class MainNavServiceProvider extends ServiceProvider
{
    public function boot()
    {
        add_filter('timber/context', function ($context) {
            $context['header'] = new Menu('header-primary-nav');

            foreach ($context['header']->items as $item) {
                $item->highlight_colour = get_field('highlight_colour', $item);
                $item->title_item = get_field('title_item', $item);
                $item->submenu_style = get_field('submenu_style', $item);
                $item->boxed_link = get_field('boxed_link', $item) ? 1 : 0;
                $item->boxed_link_image = get_field('boxed_link_image', $item);

                // if ($item->boxed_link) {
                //     $item->boxed_link_image = 'test2'; //get_field('link_image', $item);
                // }
            }

            return $context;
        });
    }
}
