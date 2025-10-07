<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class ContentPanelServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/content-panel',
                'title' => __('Content Panel'),
                // 'description' => __('Add content.'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'format-image',
                'mode' => 'preview',
                'post_types' => ['page'],
                'align_text' => 'center',
                'supports' => [
                    'align' => false,
                    'align_text' => true,
                    'jsx' => true,
                    'mode' => false,
                ]
            ]);
        });
    }

    public function render(array $block, string $content = '', bool $is_preview = false, int $post_id = 0): void
    {
        $context = Timber::get_context();

        $template = [
            [
                'core/paragraph',
                [
                    'placeholder' => 'Start adding your content here',
                ]
            ]
        ];

        $context['block']['template'] = esc_attr(json_encode($template));

        $context['block']['background_colour'] = get_field('background_colour') ?: '#6C75E1';
        $context['block']['text_colour'] = get_field('text_colour') ?: '#FFFFFF';
        $context['block']['text_align'] = $block['align_text'] ?? 'left';
        $context['block']['options'] = get_field('options') ?: [];

        Timber::render('blocks/content-panel.twig', $context);
    }
}
