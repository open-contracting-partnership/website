<?php

use Timber\Timber;

$context = Timber::context();

$context['block'] = [];

$context['block']['image'] = get_field('image');
$context['block']['show_link'] = get_field('show_link');
$context['block']['link'] = $context['block']['show_link'] ? get_field('link') : null;

if ($is_preview && $context['block']['link']) {
    $context['block']['link']['url'] = '#';
    $context['block']['link']['target'] = '';
}

// options
$context['block']['options'] = get_field('options') ?: [];

Timber::render('blocks/card-image/card-image.twig', $context);
