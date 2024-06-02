<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class ButtonServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/button',
                'title' => __('Button'),
                // 'description' => __('Highlight content within a blog post'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="inherit" viewBox="0 0 29 29"><path d="M14.1 0a14.1 14.1 0 100 28.2 14.1 14.1 0 000-28.2zM9.5 20.2v-2.7l5.4-3.3-5.4-3.1V8l10.4 6.2-10.4 6z"/></svg>',
                'post_types' => ['page'],
                'supports' => [
                    'align' => false
                ]
            ]);
        });
    }

    public function render($block, $content = '', $is_preview = false, $post_id = 0)
    {
        $context = Timber::get_context();

        $context['block'] = [];
        $context['block']['link'] = get_field('link');
        $context['block']['has_icon'] = get_field('has_icon');

        $context['block']['background_colour'] = get_field('background_colour');
        $context['block']['border_colour'] = get_field('border_colour');
        $context['block']['text_colour'] = get_field('text_colour');
        $context['block']['size'] = get_field('size') ?? 'normal';

        if ($is_preview && $context['block']['link']) {
            $context['block']['link']['url'] = '#';
            $context['block']['link']['target'] = '';
        }

        echo Timber::compile('blocks/button.twig', $context);
    }
}
