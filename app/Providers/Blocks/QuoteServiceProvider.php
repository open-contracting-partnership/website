<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class QuoteServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/quote',
                'title' => __('Quote (OCP)'),
                // 'description' => __('Highlight content within a blog post'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'format-quote',
                'keywords' => ['quote'],
                'post_types' => ['post'],
                'supports' => [
                    'align' => false
                ]
            ]);
        });
    }

    public function render(array $block, string $content = '', bool $is_preview = false, int $post_id = 0): void
    {
        $context = Timber::get_context();

        $context['block'] = [];
        $context['block']['quote'] = get_field('quote');
        $context['block']['citation'] = get_field('citation');
        $context['block']['strapline'] = get_field('strapline');

        // options
        $context['block']['options'] = get_field('options') ?: [];

        Timber::render('blocks/quote.twig', $context);
    }
}
