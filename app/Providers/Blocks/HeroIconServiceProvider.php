<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class HeroIconServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/hero-icon',
                'title' => __('Hero Icon'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'format-image',
                'keywords' => ['hero', 'icon'],
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

        $context['block']['icon'] = get_field('icon');

        // colours
        $context['block']['background_colour'] = get_field('background_colour') ?: '#FFFFFF';
        $context['block']['is_dark'] = isContrastingColourLight($context['block']['background_colour']);
        $context['block']['text_colour'] = $context['block']['is_dark'] ? '#FFF' : '#000';
        $context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

        // options
        $context['block']['options'] = get_field('options') ?: [];

        Timber::render('blocks/hero-icon.twig', $context);
    }
}
