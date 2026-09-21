<?php

use Extended\ACF\ConditionalLogic;
use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\PostObject;
use Extended\ACF\Fields\Select;
use Extended\ACF\Fields\Text;
use Extended\ACF\Fields\Url;
use Extended\ACF\Location;

register_extended_field_group([
    'title' => 'Block → Card Primary',
    'fields' => [
        Select::make('Content', 'content')
            ->instructions('Choose whether to pull in an existing post or manually enter the details for this card.')
            ->choices([
                'post' => 'Post',
                'manual_entry' => 'Manual Entry',
            ])
            ->defaultValue('manual_entry'),

        PostObject::make('Post', 'post')
            ->postTypes(['post'])
            ->postStatus(['publish'])
            ->returnFormat('id')
            ->required()
            ->conditionalLogic([
                ConditionalLogic::where('content', '==', 'post')
            ]),

        Image::make('Image', 'image')
            ->returnFormat('id')
            ->library('all')
            ->previewSize('medium')
            ->conditionalLogic([
                ConditionalLogic::where('content', '==', 'manual_entry')
            ]),

        Text::make('Title', 'title')
            ->required()
            ->conditionalLogic([
                ConditionalLogic::where('content', '==', 'manual_entry')
            ]),

        Text::make('Introduction', 'introduction')
            ->conditionalLogic([
                ConditionalLogic::where('content', '==', 'manual_entry')
            ]),

        Url::make('URL', 'url')
            ->required()
            ->conditionalLogic([
                ConditionalLogic::where('content', '==', 'manual_entry')
            ]),
    ],
    'location' => [
        Location::where('block', 'app/card-primary'),
    ],
]);
