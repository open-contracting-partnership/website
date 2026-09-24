<?php

use Timber\Timber;

$context = Timber::context();

$context['block'] = [];

$context['block']['title'] = get_field('title');
$context['block']['description'] = get_field('description');
$context['block']['image'] = get_field('image');
$context['block']['colour_scheme'] = get_field('colour_scheme');
$context['block']['links'] = get_field('links') ?: [];

if ($is_preview) {
    $context['block']['links'] = array_map(function ($item) {
        if ($item['link']) {
            $item['link']['url'] = '#';
            $item['link']['target'] = '';
        }

        return $item;
    }, $context['block']['links']);
}

// options
$context['block']['options'] = get_field('options') ?: [];

Timber::render('blocks/card-sidebar/card-sidebar.twig', $context);
