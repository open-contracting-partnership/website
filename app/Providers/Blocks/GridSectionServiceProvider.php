<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class GridSectionServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/grid-section',
                'title' => __('Grid Section'),
                'description' => __('Grid section includes a heading, strapline and a grid of contents.'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'grid-view',
                'keywords' => ['grid', 'section'],
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

        // content
        $context['block']['heading'] = get_field('heading');
        $context['block']['strapline'] = get_field('strapline');
        $context['block']['layout'] = get_field('layout');
        $context['block']['spacing'] = get_field('spacing');

        if ($is_preview && ! $context['block']['heading']) {
            $context['block']['heading'] = 'Add primary title here&hellip;';
        }

        $context['block']['allowed_inner_blocks'] = esc_attr(wp_json_encode([
            'core/heading',
            'core/paragraph',
            'acf/ocp-grid-section',
            'acf/ocp-card',
            'acf/ocp-card-embed',
            'acf/ocp-card-with-icon',
            'acf/ocp-arrow-link'
        ]));

        // colours
        $context['block']['background_colour'] = get_field('background_colour') ?: '#FFFFFF';
        $context['block']['is_dark'] = isContrastingColourLight($context['block']['background_colour']);
        $context['block']['text_colour'] = $context['block']['is_dark'] ? '#FFF' : '#000';
        $context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

        // options
        $context['block']['options'] = get_field('options') ?: [];

        Timber::render('blocks/grid-section.twig', $context);
    }
}
