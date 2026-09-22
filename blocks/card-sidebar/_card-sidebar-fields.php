<?php

use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Link;
use Extended\ACF\Fields\Repeater;
use Extended\ACF\Fields\Select;
use Extended\ACF\Fields\Text;
use Extended\ACF\Fields\Textarea;
use Extended\ACF\Location;

register_extended_field_group([
    'title' => 'Block → Card Sidebar',
    'fields' => [
        Text::make('Title', 'title'),

        Textarea::make('Description', 'description'),

        Image::make('Image', 'image')
            ->returnFormat('id')
            ->library('all')
            ->previewSize('medium'),

        Select::make('Colour Scheme', 'colour_scheme')
            ->choices([
                'grey' => 'Grey',
                'teal' => 'Teal',
                'green' => 'Green',
                'orange' => 'Orange',
                'white' => 'White',
                'transparent' => 'Transparent',
            ])
            ->defaultValue('grey'),

        Repeater::make('Links', 'links')
            ->fields([
                Link::make('Link', 'link')
                    ->returnFormat('array')
                    ->required(),
            ]),
    ],
    'location' => [
        Location::where('block', 'app/card-sidebar'),
    ],
]);
