<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class ContentWithIconServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/content-with-icon',
                'title' => __('Content With Icon'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                // 'icon' => '<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128"><path fill="#606" d="M0 0h128v128H0z"/><path fill="#fff" d="M41 59h37.1v10H41zM41 92h45.1v10H41zM41 28h43.1v10H41z"/><path fill="#fff" d="M41 28h11.1v74H41z"/></svg>',
                // 'mode' => 'preview',
                'supports' => [
                    'align' => false,
                    'jsx' => true,
                ],
            ]);
        });
    }

    public function render($block, $content = '', $is_preview = false, $post_id = 0)
    {
        $context = Timber::get_context();

        $context['block']['background_colour'] = get_field('background_colour');
        $context['block']['text_colour'] = get_field('text_colour');
        $context['block']['accent_colour'] = get_field('accent_colour');
        $context['block']['icon'] = get_field('icon');
        $context['block']['preview'] = $is_preview;

        echo Timber::compile('blocks/content-with-icon.twig', $context);
    }
}
