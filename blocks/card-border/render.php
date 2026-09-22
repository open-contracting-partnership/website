<?php

use App\Cards\ResourceCard;
use Timber\Timber;

$context = Timber::context();

$context['block'] = [];

if (get_field('content') === 'resource') {
    $post = Timber::get_post(get_field('resource'));

    if (!$post || $post->post_status !== 'publish') {
        return;
    }

    $resource = ResourceCard::convertTimberPost($post);

    $context['block']['lead'] = $resource['type_label'] ?? '';
    $context['block']['title'] = $resource['title'];
    $context['block']['description'] = '';
    $context['block']['buttons'] = [
        [
            'link' => [
                'title' => 'Read more',
                'url' => $resource['url'],
                'target' => '',
            ],
        ],
    ];

} else {
    $context['block']['lead'] = get_field('lead');
    $context['block']['title'] = get_field('title');
    $context['block']['description'] = get_field('description');
    $context['block']['buttons'] = get_field('buttons') ?: [];
}

if ($is_preview) {
    if ($context['block']['buttons']) {
        $context['block']['buttons'] = array_map(function ($button) {
            $button['link']['url'] = '#';
            $button['link']['target'] = '';

            return $button;
        }, $context['block']['buttons']);
    }
}

// colours
$context['block']['highlight_colour'] = get_field('highlight_colour') ?: '#000000';
$context['block']['background_colour'] = get_field('background_colour') ?: '#FFFFFF';
$context['block']['is_dark'] = isContrastingColourLight($context['block']['background_colour']);
$context['block']['text_colour'] = $context['block']['is_dark'] ? '#FFF' : '#000';
$context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

// options
$context['block']['options'] = get_field('options') ?: [];

Timber::render('blocks/card-border/card-border.twig', $context);
