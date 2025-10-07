<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class StatsServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/stats',
                'title' => __('Stats'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'supports' => [
                    'align' => false,
                ],
                'enqueue_assets' => function () {
                    wp_enqueue_script('block-stats', get_template_directory_uri() . '/dist/js/block-stats.js', ['manifest'], false, true);
                },
            ]);
        });
    }

    public function render(array $block, string $content = '', bool $is_preview = false, int $post_id = 0): void
    {
        $context = Timber::get_context();

        $context['block']['heading'] = get_field('heading');
        $context['block']['heading_size'] = get_field('heading_size');
        $context['block']['strapline'] = get_field('strapline');
        $context['block']['previous_block_colour'] = get_field('previous_block_colour');
        $context['block']['stats'] = get_field('stats');
        $context['block']['show_plus_icons'] = get_field('show_plus_icons') ?? true;
        $context['block']['preview'] = $is_preview;

        Timber::render('blocks/stats.twig', $context);
    }
}
