<?php

namespace App\Providers\Blocks;

use App\Cards\ResourceCard;
use App\Providers\Blocks\BaseBlock;
use Timber\Timber;

class BlogHighlightServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/blog-highlight',
                'title' => __('Blog Highlight'),
                'description' => __('Highlight content within a blog post'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'grid-view',
                'keywords' => ['resource', 'resources'],
                'post_types' => ['post'],
                'supports' => [
                    'align' => false
                ]
            ]);
        });
    }

    public function render()
    {
        $context = Timber::get_context();

        $context['block'] = [];
        $context['block']['content'] = get_field('content');

        $context['block']['background_colour'] = get_field('background_colour') ?: '#6C75E1';
        $context['block']['text_colour'] = isContrastingColourLight($context['block']['background_colour']) ? '#FFF' : '#000';
        $context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

        // options
        $context['block']['options'] = get_field('options') ?: [];

        echo Timber::compile('blocks/blog-highlight.twig', $context);
    }
}
