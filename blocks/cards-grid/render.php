<?php

use App\Blocks\CardsGrid\CardsGridConfig;
use App\Fields\BlockSpacingControls;
use Timber\Timber;

$context = Timber::context();

$context['block']['is_preview'] = $is_preview;
$context['block']['card_type'] = get_field('card_type');
$context['block']['block_spacing'] = BlockSpacingControls::makeContext();

$allowedCards = match ($context['block']['card_type']) {
    'card-primary' => 'app/card-primary',
    'card-half-image' => 'app/card-half-image',
    'card-with-icon' => 'acf/ocp-card-with-icon',
    'card-resource' => 'app/card-resource',
    'card-person' => 'app/card-person',
    'card-feature' => 'app/card-feature',
    'card-border' => 'app/card-border',
    'card-image' => 'app/card-image',
    default => null,
};

$context['block']['allowed_blocks'] = esc_attr(json_encode([$allowedCards]));
$context['block']['variation'] = null;

if (CardsGridConfig::hasVariation($context['block']['card_type'])) {
    $variationsFieldName = CardsGridConfig::getVariationsFieldName($context['block']['card_type']);

    $context['block']['variation'] = get_field($variationsFieldName) ?: CardsGridConfig::getDefaultVariation($context['block']['card_type']);
}

Timber::render('_cards-grid.twig', $context);
