<?php

use App\Fields\BlockSpacingControls;
use Extended\ACF\Fields\Select;
use Extended\ACF\Location;

register_extended_field_group([
    'title' => 'Block → Grid Container',
    'fields' => [
        Select::make('Column Gap', 'column_gap')
            ->choices([
                'small' => 'Small',
                'normal' => 'Normal',
            ])
            ->default('normal')
            ->required(),

        Select::make('Row Gap', 'row_gap')
            ->choices([
                'none' => 'None',
                'normal' => 'Normal',
            ])
            ->default('normal')
            ->required(),

        ...BlockSpacingControls::fields(),
    ],
    'location' => [
        Location::where('block', 'app/grid-container'),
    ],
]);
