<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class TimelineServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/timeline',
                'title' => __('Timeline'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'supports' => [
                    'align' => false,
                ],
                'enqueue_assets' => function () {
                    wp_enqueue_style(
                        'timeline-styles',
                        "https://cdn.knightlab.com/libs/timeline3/latest/css/timeline.css",
                        [],
                        null
                    );
                    wp_enqueue_script(
                        'block-timeline',
                        get_template_directory_uri() . '/dist/js/block-timeline.js',
                        ['manifest'],
                        filemtime(get_template_directory() . '/dist/js/block-timeline.js'),
                        true
                    );
                },
            ]);
        });
    }

    public function render($block, $is_preview = false)
    {
        $context = Timber::get_context();

        $context['block'] = [];
        $context['block']['custom_classes'] = $block['className'] ?? '';
        $context['block']['google_sheet_url'] = get_field('google_sheet_url');
        $context['block']['is_preview'] = $is_preview;

        echo Timber::compile('blocks/timeline.twig', $context);
    }
}
