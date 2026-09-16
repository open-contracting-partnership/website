<?php

use Laminas\Diactoros\Response\RedirectResponse;
use Rareloop\Lumberjack\Facades\Router;

foreach (['apple-touch-icon.png', 'apple-touch-icon-precomposed.png'] as $icon) {
    Router::get($icon, function () {
        return new RedirectResponse(
            get_template_directory_uri() . '/resources/img/favicons/apple-touch-icon.png',
            301
        );
    });
}
