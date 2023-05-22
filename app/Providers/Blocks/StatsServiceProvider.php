<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class StatsServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
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

    public function render($block, $content = '', $is_preview = false, $post_id = 0)
    {
        $context = Timber::get_context();

        $context['block']['heading'] = get_field('heading');
        $context['block']['strapline'] = get_field('strapline');
        $context['block']['previous_block_colour'] = get_field('previous_block_colour');
        $context['block']['stats'] = get_field('stats');
        $context['block']['preview'] = $is_preview;

        echo Timber::compile('blocks/stats.twig', $context);
    }
}
