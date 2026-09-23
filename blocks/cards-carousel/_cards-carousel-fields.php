<?php

use App\Blocks\CardsCarousel\CardsCarouselConfig;
use App\Fields\BlockSpacingControls;
use Extended\ACF\Fields\Select;
use Extended\ACF\Location;

register_extended_field_group([
    'title' => 'Block → Cards Carousel',
    'key' => 'block_cards_carousel',
    'fields' => [
        Select::make('Card Type', 'card_type')
            ->instructions('<strong>Note: </strong> Only change the card type when there are no cards, doing so when cards are present will cause issues.')
            ->choices(CardsCarouselConfig::getCardTypeChoices())
            ->allowNull(),

        ...CardsCarouselConfig::getCardTypeVariations(),

        ...BlockSpacingControls::fields(),
    ],
    'location' => [
        Location::where('block', 'app/cards-carousel'),
    ],
]);
