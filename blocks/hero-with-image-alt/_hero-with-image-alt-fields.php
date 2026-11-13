<?php

use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Link;
use Extended\ACF\Fields\Textarea;
use Extended\ACF\Location;

register_extended_field_group([
    'title' => 'Block → Hero With Image Alt',
    'fields' => [
        Textarea::make('Heading', 'heading')
            ->rows(2)
            ->newLines('br'),

        Textarea::make('Content', 'content'),

        Link::make('CTA', 'cta')
            ->format('array'),

        Image::make('Background Image', 'background_image')
            ->format('array')
            ->library('all')
            ->previewSize('medium'),
    ],
    'location' => [
        Location::where('block', 'app/hero-with-image-alt'),
    ],
]);
