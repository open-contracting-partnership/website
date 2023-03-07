<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class CardWithIconServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
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

    public function render($block, $content = '', $is_preview = false, $post_id = 0)
    {
        $context = Timber::get_context();

        $context['block'] = [];

        // content
        $context['block']['heading'] = get_field('heading');
        $context['block']['strapline'] = get_field('strapline');
        $context['block']['icon'] = get_field('icon');
        $context['block']['link'] = get_field('link');

        if ($is_preview) {
            $context['block']['link']['url'] = '#';
            $context['block']['link']['target'] = '';
        }

        // colours
        $context['block']['background_colour'] = get_field('background_colour') ?: '#FFFFFF';
        $context['block']['is_dark'] = isContrastingColourLight($context['block']['background_colour']);
        $context['block']['text_colour'] = $context['block']['is_dark'] ? '#FFF' : '#000';
        $context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

        // options
        $context['block']['options'] = get_field('options') ?: [];

        echo Timber::compile('blocks/card-with-icon.twig', $context);
    }
}
