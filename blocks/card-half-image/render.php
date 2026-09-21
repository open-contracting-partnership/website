<?php

use Timber\Timber;

$context = Timber::context();

$context['card']['title'] = get_field('title');
$context['card']['strapline'] = get_field('strapline');
$context['card']['image'] = get_field('image');
$context['card']['link'] = get_field('link');
$context['card']['background_colour'] = get_field('background_colour');
$context['card']['hover_colour'] = get_field('hover_colour');
$context['card']['text_colour'] = get_field('text_colour');

Timber::render('views/cards/half-image.twig', $context);
