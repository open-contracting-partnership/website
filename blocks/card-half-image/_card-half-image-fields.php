<?php

use Extended\ACF\Fields\ColorPicker;
use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Text;
use Extended\ACF\Fields\Url;
use Extended\ACF\Location;

register_extended_field_group([
    'title' => 'Block → Card Half Image',
    'fields' => [
        Text::make('Title', 'title')
            ->required(),

        Text::make('Strapline', 'strapline'),

        Image::make('Image', 'image')
            ->returnFormat('id')
            ->library('all')
            ->previewSize('medium'),

        Url::make('Link URL', 'link'),

        // Link::make('Link', 'link')
        //     ->returnFormat('array'),

        ColorPicker::make('Background Colour', 'background_colour')
            ->defaultValue('#B9C504'),

        ColorPicker::make('Hover Colour', 'hover_colour')
            ->defaultValue('#B9C504'),

        ColorPicker::make('Text Colour', 'text_colour')
            ->defaultValue('#000000'),
    ],
    'location' => [
        Location::where('block', 'app/card-half-image'),
    ],
]);
