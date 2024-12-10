<?php

use Timber\Timber;

$context = Timber::get_context();

$context['block'] = [];
$context['block']['custom_classes'] = $block['className'] ?? '';

$context['block']['size'] = get_field('size');
$context['block']['margin'] = get_field('margin');

$context['block']['template'] = esc_attr(json_encode([
    [
        'core/heading',
        [
            'level' => 2,
            'placeholder' => 'Heading...',
        ]
    ],
]));

$context['block']['allowed_blocks'] = [
    'core/heading',
];

Timber::render('heading.twig', $context);
