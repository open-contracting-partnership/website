<?php

use Timber\Timber;

$context = Timber::context();

$context['block']['column_identifier'] = md5((string) rand());

$context['block']['display'] = collect(get_field('display') ?? [
    'mobile' => true,
    'tablet' => true,
    'desktop' => true
])
    ->map(function ($display) {
        return $display ? 'grid' : 'none';
    });

$context['block']['span'] = get_field('columns');
$context['block']['offset'] = get_field('offsets');
$context['block']['order'] = get_field('orders');
$context['block']['is_preview'] = $is_preview;

$context['block']['template'] = esc_attr(json_encode([
    [
        'core/paragraph',
        [
            'placeholder' => 'Start adding your content here',
        ]
    ]
]));

Timber::render('grid-column.twig', $context);
