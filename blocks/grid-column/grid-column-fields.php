<?php

use Extended\ACF\Fields\Group;
use Extended\ACF\Fields\Number;
use Extended\ACF\Fields\TrueFalse;
use Extended\ACF\Location;

register_extended_field_group([
    'title' => 'Block → Grid Column',
    'fields' => [
        Group::make('Display', 'display')
            ->layout('block')
            ->fields([
                TrueFalse::make('Mobile', 'mobile')
                    ->default(1)
                    ->column(33),

                TrueFalse::make('Tablet', 'tablet')
                    ->default(1)
                    ->column(33),

                TrueFalse::make('Desktop', 'desktop')
                    ->default(1)
                    ->column(33),
            ]),

        Group::make('Columns', 'columns')
            ->layout('block')
            ->fields([
                Number::make('Mobile', 'mobile')
                    ->default(12)
                    ->min(1)
                    ->max(12)
                    ->step(1)
                    ->column(33),

                Number::make('Tablet', 'tablet')
                    ->default(12)
                    ->min(1)
                    ->max(12)
                    ->step(1)
                    ->column(33),

                Number::make('Desktop', 'desktop')
                    ->default(12)
                    ->min(1)
                    ->max(12)
                    ->step(1)
                    ->column(33),
            ]),

        Group::make('Offsets', 'offsets')
            ->layout('block')
            ->fields([
                Number::make('Mobile', 'mobile')
                    ->default(0)
                    ->min(0)
                    ->max(12)
                    ->step(1)
                    ->column(33),

                Number::make('Tablet', 'tablet')
                    ->default(0)
                    ->min(0)
                    ->max(12)
                    ->step(1)
                    ->column(33),

                Number::make('Desktop', 'desktop')
                    ->default(0)
                    ->min(0)
                    ->max(12)
                    ->step(1)
                    ->column(33),
            ]),

        Group::make('Orders', 'orders')
            ->layout('block')
            ->fields([
                Number::make('Mobile', 'mobile')
                    ->default(0)
                    ->step(1)
                    ->column(33),

                Number::make('Tablet', 'tablet')
                    ->default(0)
                    ->step(1)
                    ->column(33),

                Number::make('Desktop', 'desktop')
                    ->default(0)
                    ->step(1)
                    ->column(33),
            ]),
    ],
    'location' => [
        Location::where('block', '==', 'app/grid-column'),
    ],
]);
