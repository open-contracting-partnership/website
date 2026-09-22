<?php

use Extended\ACF\ConditionalLogic;
use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Link;
use Extended\ACF\Fields\TrueFalse;
use Extended\ACF\Location;

register_extended_field_group([
    'title' => 'Block → Card Image',
    'fields' => [
        Image::make('Image', 'image')
            ->returnFormat('id')
            ->library('all')
            ->previewSize('medium')
            ->required(),

        TrueFalse::make('Show Link', 'show_link')
            ->defaultValue(false),

        Link::make('Link', 'link')
            ->returnFormat('array')
            ->required()
            ->conditionalLogic([
                ConditionalLogic::where('show_link', '==', 1)
            ]),
    ],
    'location' => [
        Location::where('block', 'app/card-image'),
    ],
]);
