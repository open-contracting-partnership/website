<?php

use App\Blocks\CardsGrid\CardsGridConfig;
use App\Fields\BlockSpacingControls;
use Extended\ACF\Fields\Select;
use Extended\ACF\Location;

register_extended_field_group([
    'title' => 'Block → Cards Grid',
    'key' => 'block_card_grid',
    'fields' => [
        Select::make('Card Type', 'card_type')
            ->instructions('<strong>Note: </strong> Only change the card type when there are no cards, doing so when cards are present will cause issues.')
            ->choices(CardsGridConfig::getCardTypeChoices())
            ->allowNull(),

        ...CardsGridConfig::getCardTypeVariations(),

        ...BlockSpacingControls::fields(),
    ],
    'location' => [
        Location::where('block', 'app/cards-grid'),
    ],
]);
