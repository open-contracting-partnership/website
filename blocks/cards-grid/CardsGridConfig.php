<?php

namespace App\Blocks\CardsGrid;

use Extended\ACF\ConditionalLogic;
use Extended\ACF\Fields\Select;
use Illuminate\Support\Str;

class CardsGridConfig
{
    protected static $cardTypes = [
        'card-primary' => [
            'title' => 'Primary',
            'variations' => [
                'three-columns' => 'Three Columns',
            ],
            'default_variation' => 'three-columns',
        ],
        'card-half-image' => [
            'title' => 'Half Image',
            'variations' => [
                'two-columns' => 'Two Columns',
            ],
            'default_variation' => 'two-columns',
        ],
        'card-with-icon' => [
            'title' => 'With Icon',
            'variations' => [
                'two-columns' => 'Two Columns',
            ],
            'default_variation' => 'two-columns',
        ],
    ];

    public static function getCardTypeChoices(): array
    {
        return collect(self::$cardTypes)
            ->mapWithKeys(function ($item, $key) {
                return [$key => $item['title']];
            })
            ->toArray();
    }

    public static function getVariationsFieldName(string $cardType): string
    {
        return sprintf(
            'variations_%s',
            Str::slug($cardType, '_')
        );
    }

    public static function getCardTypeVariations(): array
    {
        return collect(self::$cardTypes)
            ->filter(fn ($item) => isset($item['variations']))
            ->map(function ($cardType, $cardKey) {
                $fieldName = self::getVariationsFieldName($cardKey);

                return Select::make('Variations', $fieldName)
                    ->choices($cardType['variations'])
                    ->defaultValue($cardType['default_variation'] ?? array_keys($cardType['variations'])[0])
                    ->conditionalLogic([
                        ConditionalLogic::where('card_type', '==', $cardKey)
                    ]);
            })
            ->values()
            ->toArray();
    }

    public static function getDefaultVariation(string $cardType): ?string
    {
        return self::$cardTypes[$cardType]['default_variation'] ?? null;
    }

    public static function hasVariation(?string $cardType = null): bool
    {
        if (! $cardType) {
            return false;
        }

        return isset(self::$cardTypes[$cardType]['variations']);
    }
}
