<?php

use Timber\Timber;

$context = Timber::context();

$context['block']['heading'] = get_field('heading');
$context['block']['content'] = get_field('content');
$context['block']['cta'] = get_field('cta');
$context['block']['background_image'] = get_field('background_image');
$context['block']['preview'] = $is_preview;

Timber::render('hero-with-image-alt.twig', $context);
