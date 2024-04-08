<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class OurReportingGridServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/our-reporting-grid',
                'title' => __('Our Reporting Grid'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                // 'icon' => '<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128"><path fill="#606" d="M0 0h128v128H0z"/><path fill="#fff" d="M41 59h37.1v10H41zM41 92h45.1v10H41zM41 28h43.1v10H41z"/><path fill="#fff" d="M41 28h11.1v74H41z"/></svg>',
                // 'mode' => 'preview',
                'supports' => [
                    'align' => false,
                ],
            ]);
        });
    }

    public function render($block, $content = '', $is_preview = false, $post_id = 0)
    {
        $context = Timber::get_context();

        $context['block']['heading'] = get_field('heading');
        $context['block']['content_type'] = get_field('content_type') ?? 'card-strapline';
        $context['block']['strapline'] = get_field('card_strapline');
        $context['block']['excerpt'] = get_field('card_excerpt');
        $context['block']['previous_block_colour'] = get_field('previous_block_colour');
        $context['block']['cards'] = collect(get_field('cards'))->map(function ($card) {
            $card['type'] = ! empty($card['url']) ? 'a' : 'div';

            return $card;
        });

        $context['block']['banner_image'] = get_field('banner_image');
        $context['block']['preview'] = $is_preview;

        echo Timber::compile('blocks/our-reporting-grid.twig', $context);
    }
}
