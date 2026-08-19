<?php

namespace App\Fields;

use Extended\ACF\ConditionalLogic;
use Extended\ACF\Fields\Accordion;
use Extended\ACF\Fields\ButtonGroup;
use Extended\ACF\Fields\Select;

class BlockSpacingControls
{
    public static function fields(
        string $blockDefault = 'lg',
        ?string $topDefault = null,
        ?string $bottomDefault = null
    ): array {
        if (! $topDefault) {
            $topDefault = $blockDefault;
        }

        if (! $bottomDefault) {
            $bottomDefault = $blockDefault;
        }

        // TODO: make this an enum

        $coreSpacingOptions = collect([
            'none' => 'None',
            'xs' => 'Tiny',
            'sm' => 'Small',
            'md' => 'Medium',
            'lg' => 'Large',
            'xl' => 'Extra Large',
            '2xl' => '2× Extra Large',
        ]);

        $verticalSpacingOptions = $coreSpacingOptions->mapWithKeys(fn ($label, $value) => [
            $value => $label . ($value === $blockDefault ? ' (default)' : ''),
        ])->toArray();

        $topSpacingOptions = $coreSpacingOptions->mapWithKeys(fn ($label, $value) => [
            $value => $label . ($value === $topDefault ? ' (default)' : ''),
        ])->toArray();

        $bottomSpacingOptions = $coreSpacingOptions->mapWithKeys(fn ($label, $value) => [
            $value => $label . ($value === $bottomDefault ? ' (default)' : ''),
        ])->toArray();

        return [
            Accordion::make('Vertical Spacing')
                ->instructions('Control the vertical spacing of this block.')
                ->multiExpand(),

            ButtonGroup::make('', 'vertical_spacing_override')
                ->choices([
                    'default' => 'Default',
                    'basic' => 'Basic',
                    'advanced' => 'Advanced'
                ])
                ->defaultValue('default'),

            Select::make('Spacing', 'vertical_spacing__block')
                ->choices($verticalSpacingOptions)
                ->defaultValue($blockDefault)
                ->returnFormat('value')
                ->required()
                ->conditionalLogic([
                    ConditionalLogic::where('vertical_spacing_override', '==', 'basic')
                ]),

            Select::make('Top Spacing', 'vertical_spacing__top')
                ->choices($topSpacingOptions)
                ->defaultValue($topDefault)
                ->returnFormat('value')
                ->required()
                ->conditionalLogic([
                    ConditionalLogic::where('vertical_spacing_override', '==', 'advanced')
                ]),

            Select::make('Bottom Spacing', 'vertical_spacing__bottom')
                ->choices($bottomSpacingOptions)
                ->defaultValue($bottomDefault)
                ->returnFormat('value')
                ->required()
                ->conditionalLogic([
                    ConditionalLogic::where('vertical_spacing_override', '==', 'advanced')
                ]),
        ];
    }

    public static function makeContext(
        string $blockDefault = 'lg',
        ?string $topDefault = null,
        ?string $bottomDefault = null
    ): array {
        if (! $topDefault) {
            $topDefault = $blockDefault;
        }

        if (! $bottomDefault) {
            $bottomDefault = $blockDefault;
        }

        $verticalSpacingOverride = get_field('vertical_spacing_override') ?: 'default';

        return match ($verticalSpacingOverride) {
            'basic' => [
                'top' => get_field('vertical_spacing__block'),
                'bottom' => get_field('vertical_spacing__block'),
            ],
            'advanced' => [
                'top' => get_field('vertical_spacing__top'),
                'bottom' => get_field('vertical_spacing__bottom'),
            ],
            default => [
                'top' => $topDefault,
                'bottom' => $bottomDefault,
            ],
        };
    }
}
