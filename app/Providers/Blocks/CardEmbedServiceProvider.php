<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class CardEmbedServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/card-embed',
                'title' => __('Card Embed'),
                // 'description' => __('Grid section includes a heading, strapline and a grid of contents.'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'grid-view',
                'keywords' => ['card', 'embed'],
                'post_types' => ['page'],
                'supports' => [
                    'align' => false,
                    'jsx' => true
                ]
            ]);
        });
    }

    public function render(array $block, string $content = '', bool $is_preview = false, int $post_id = 0): void
    {
        $context = Timber::get_context();

        $context['block'] = [];

        $context['block']['buttons'] = get_field('buttons');

        if ($is_preview && $context['block']['buttons']) {
            $context['block']['buttons'] = array_map(function ($button) {
                $button['link']['url'] = '#';
                $button['link']['target'] = '';

                return $button;
            }, $context['block']['buttons']);
        }

        // $context['block']['allowed_inner_blocks'] = esc_attr(wp_json_encode([
        //  'core/heading',
        //  'core/paragraph',
        //  'acf/ocp-grid-section',
        //  'acf/ocp-card',
        //  'acf/ocp-card-embed',
        //  'acf/ocp-card-with-icon',
        //  'acf/ocp-arrow-link'
        // ]));

        // options
        $context['block']['options'] = get_field('options') ?: [];

        Timber::render('blocks/card-embed.twig', $context);
    }
}
