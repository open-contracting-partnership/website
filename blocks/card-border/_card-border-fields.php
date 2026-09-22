<?php

use Extended\ACF\ConditionalLogic;
use Extended\ACF\Fields\ColorPicker;
use Extended\ACF\Fields\Link;
use Extended\ACF\Fields\PostObject;
use Extended\ACF\Fields\Repeater;
use Extended\ACF\Fields\Select;
use Extended\ACF\Fields\Text;
use Extended\ACF\Location;

register_extended_field_group([
    'title' => 'Block → Card Border',
    'fields' => [
        Select::make('Content', 'content')
            ->instructions('Choose whether to pull in an existing resource or manually enter the details for this card.')
            ->choices([
                'resource' => 'Resource',
                'manual_entry' => 'Manual Entry',
            ])
            ->defaultValue('manual_entry'),

        PostObject::make('Resource', 'resource')
            ->postTypes(['resource'])
            ->postStatus(['publish'])
            ->returnFormat('id')
            ->required()
            ->conditionalLogic([
                ConditionalLogic::where('content', '==', 'resource')
            ]),

        Text::make('Lead', 'lead')
            ->conditionalLogic([
                ConditionalLogic::where('content', '==', 'manual_entry')
            ]),

        Text::make('Title', 'title')
            ->required()
            ->conditionalLogic([
                ConditionalLogic::where('content', '==', 'manual_entry')
            ]),

        Text::make('Description', 'description')
            ->conditionalLogic([
                ConditionalLogic::where('content', '==', 'manual_entry')
            ]),

        Repeater::make('Buttons', 'buttons')
            ->fields([
                Link::make('Link', 'link')
                    ->returnFormat('array')
                    ->required(),
            ])
            ->conditionalLogic([
                ConditionalLogic::where('content', '==', 'manual_entry')
            ]),

        ColorPicker::make('Highlight Colour', 'highlight_colour'),

        ColorPicker::make('Background Colour', 'background_colour'),

        ColorPicker::make('Text Colour', 'text_colour'),
    ],
    'location' => [
        Location::where('block', 'app/card-border'),
    ],
]);
