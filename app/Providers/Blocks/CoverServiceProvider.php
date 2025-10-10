<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class CoverServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/cover',
                'title' => __('Cover'),
                'description' => __('Add an image with a text overlay — great for headers.'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'format-image',
                'keywords' => ['cover'],
                'post_types' => ['page'],
                'supports' => [
                    'align' => false,
                    'jsx' => true,
                ]
            ]);
        });
    }

    public function render(array $block, string $content = '', bool $is_preview = false, int $post_id = 0): void
    {
        $context = Timber::get_context();

        $context['block'] = [];

        // provide extra context, so the template can output the old heading content if needed
        $context['block']['is_legacy'] = get_field('heading') && empty($content);
        $context['block']['is_preview'] = $is_preview;

        // content
        $context['block']['heading'] = get_field('heading') ?: 'Add primary title here&hellip;';
        $context['block']['image'] = get_field('image');
        $context['block']['text_colour'] = get_field('text_colour');
        $context['block']['overlay_color'] = get_field('overlay_colour') ?: '#000000';
        $context['block']['background_opacity'] = get_field('background_opacity') / 100;

        $context['block']['background_color'] = hex2rgba(
            $context['block']['overlay_color'],
            $context['block']['background_opacity']
        );

        // options
        $context['block']['options'] = get_field('options') ?: [];

        Timber::render('blocks/cover.twig', $context);
    }
}
