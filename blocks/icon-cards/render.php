<?php

use Timber\Timber;

$context = Timber::get_context();

$context['block']['icon_cards'] = get_field('icon_cards');
$context['block']['preview'] = $is_preview;

Timber::render('icon-cards.twig', $context);
