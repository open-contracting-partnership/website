<?php

use Timber\Timber;

$context = Timber::context();

$context['block'] = [];

$context['block']['image'] = get_field('image');
$context['block']['show_link'] = get_field('show_link');
$context['block']['link'] = $context['block']['show_link'] ? get_field('link') : null;

// options
$context['block']['options'] = get_field('options') ?: [];

Timber::render('blocks/card-image/card-image.twig', $context);
