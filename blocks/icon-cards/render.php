<?php

use Timber\Timber;

$context = Timber::context();

$context['block']['icon_cards'] = get_field('icon_cards');
$context['block']['preview'] = $is_preview;

Timber::render('icon-cards.twig', $context);
