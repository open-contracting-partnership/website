<?php

use Extended\ACF\Fields\ColorPicker;
use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Text;
use Extended\ACF\Fields\URL;
use Extended\ACF\Location;

register_extended_field_group([
    'title' => 'Block → Card Half Image',
    'fields' => [
        Text::make('Title', 'title')
            ->required(),

        Text::make('Strapline', 'strapline'),

        Image::make('Image', 'image')
            ->format('id')
            ->library('all')
            ->previewSize('medium'),

        URL::make('Link URL', 'link'),

        // Link::make('Link', 'link')
        //     ->format('array'),

        ColorPicker::make('Background Colour', 'background_colour')
            ->default('#B9C504'),

        ColorPicker::make('Hover Colour', 'hover_colour')
            ->default('#B9C504'),

        ColorPicker::make('Text Colour', 'text_colour')
            ->default('#000000'),
    ],
    'location' => [
        Location::where('block', 'app/card-half-image'),
    ],
]);
