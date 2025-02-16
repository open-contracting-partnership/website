<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class ReportHeaderServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/report-header',
                'title' => __('Report Header'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                // 'icon' => '<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128"><path fill="#606" d="M0 0h128v128H0z"/><path fill="#fff" d="M41 59h37.1v10H41zM41 92h45.1v10H41zM41 28h43.1v10H41z"/><path fill="#fff" d="M41 28h11.1v74H41z"/></svg>',
                // 'mode' => 'preview',
                'supports' => [
                    'align' => false,
                ],
                'enqueue_assets' => function () {
                    wp_enqueue_script('scroll-prompt', get_template_directory_uri() . '/dist/js/scroll-prompt.js', ['manifest'], false, true);
                },
            ]);
        });
    }

    public function render($block, $content = '', $is_preview = false, $post_id = 0)
    {
        $context = Timber::get_context();

        $context['block']['heading'] = get_field('heading');
        $context['block']['strapline'] = get_field('strapline');
        $context['block']['background_image'] = get_field('background_image');
        $context['block']['background_colour'] = get_field('background_colour');
        $context['block']['text_colour'] = get_field('text_colour');
        $context['block']['header_top'] = get_field('header_top') ?? 7.6;
        $context['block']['heading_size'] = get_field('heading_size') ?? 1;
        $context['block']['strapline_size'] = get_field('strapline_size') ?? 1;
        $context['block']['preview'] = $is_preview;

        echo Timber::compile('blocks/report-header.twig', $context);
    }
}
