<?php

use Extended\ACF\Fields\Image;
use Extended\ACF\Location;

register_extended_field_group([
    'title' => 'Block → Card Image',
    'fields' => [
        Image::make('Image', 'image')
            ->returnFormat('id')
            ->library('all')
            ->previewSize('medium')
            ->required(),
    ],
    'location' => [
        Location::where('block', 'app/card-image'),
    ],
]);
