<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class CardWithIconServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/card-with-icon',
                'title' => __('Card (with Icon)'),
                // 'description' => __('Grid section includes a heading, strapline and a grid of contents.'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'grid-view',
                'keywords' => ['icon', 'card'],
                'post_types' => ['page'],
                'supports' => [
                    'align' => false,
                ]
            ]);
        });
    }

    public function render(array $block, string $content = '', bool $is_preview = false, int $post_id = 0): void
    {
        $context = Timber::context();

        $context['block'] = [];

        // content
        $context['block']['heading'] = get_field('heading');
        $context['block']['strapline'] = strip_tags(get_field('strapline'), '<p><a><strong><em>');
        $context['block']['icon'] = get_field('icon');
        $context['block']['link'] = get_field('link');

        // colours
        $context['block']['background_colour'] = get_field('background_colour') ?: '#FFFFFF';
        $context['block']['is_dark'] = isContrastingColourLight($context['block']['background_colour']);
        $context['block']['text_colour'] = $context['block']['is_dark'] ? '#FFF' : '#000';
        $context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

        // options
        $context['block']['options'] = get_field('options') ?: [];

        Timber::render('blocks/card-with-icon.twig', $context);
    }
}
