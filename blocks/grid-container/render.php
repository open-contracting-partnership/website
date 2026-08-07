<?php

use App\Fields\BlockSpacingControls;
use Timber\Timber;

$context = Timber::context();

$context['block']['allowed_inner_blocks'] = esc_attr(wp_json_encode([
    'app/grid-column',
]));

$context['block']['template'] = esc_attr(json_encode([
    [
        'app/grid-column',
    ]
]));

$context['block']['is_preview'] = $is_preview ? 'true' : 'false';
$context['block']['column_gap'] = get_field('column_gap') ?: 'normal';
$context['block']['row_gap'] = get_field('row_gap') ?: 'normal';
$context['block']['block_spacing'] = BlockSpacingControls::makeContext();

Timber::render('grid-container.twig', $context);
