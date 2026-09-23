<?php

use App\Blocks\CardsCarousel\CardsCarouselConfig;
use App\Fields\BlockSpacingControls;
use Timber\Timber;

$context = Timber::context();

$context['block']['is_preview'] = $is_preview;
$context['block']['card_type'] = get_field('card_type');
$context['block']['block_spacing'] = BlockSpacingControls::makeContext();

$allowedCards = match ($context['block']['card_type']) {
    'card-primary' => 'app/card-primary',
    default => null,
};

$context['block']['allowed_blocks'] = esc_attr(json_encode([$allowedCards]));
$context['block']['variation'] = null;

if (CardsCarouselConfig::hasVariation($context['block']['card_type'])) {
    $variationsFieldName = CardsCarouselConfig::getVariationsFieldName($context['block']['card_type']);

    $context['block']['variation'] = get_field($variationsFieldName) ?: CardsCarouselConfig::getDefaultVariation($context['block']['card_type']);
}

Timber::render('_cards-carousel.twig', $context);
