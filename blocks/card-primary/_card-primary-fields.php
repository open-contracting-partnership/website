<?php

use Extended\ACF\ConditionalLogic;
use Extended\ACF\Fields\DatePicker;
use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Link;
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

        Text::make('Strapline', 'strapline')
            ->required()
            ->conditionalLogic([
                ConditionalLogic::where('content', '==', 'manual_entry')
            ]),

        Select::class::make('Link Type', 'link_type')
            ->choices([
                'button' => 'Button',
                'heading_link' => 'Heading Link',
            ])
            ->defaultValue('button')
            ->required()
            ->conditionalLogic([
                ConditionalLogic::where('content', '==', 'manual_entry')
            ]),

        Link::make('Link', 'link')
            ->required()
            ->conditionalLogic([
                ConditionalLogic::where('content', '==', 'manual_entry')
                    ->and('link_type', '==', 'button')
            ]),

        Url::make('URL', 'heading_url')
            ->required()
            ->conditionalLogic([
                ConditionalLogic::where('content', '==', 'manual_entry')
                    ->and('link_type', '==', 'heading_link')
            ]),
    ],
    'location' => [
        Location::where('block', 'app/card-primary'),
    ],
]);
