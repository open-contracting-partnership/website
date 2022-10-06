<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class AccordionItemServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/accordion-item',
                'title' => __('Accordion Item'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                // 'icon' => '<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128"><path fill="#606" d="M0 0h128v128H0z"/><path fill="#fff" d="M41 59h37.1v10H41zM41 92h45.1v10H41zM41 28h43.1v10H41z"/><path fill="#fff" d="M41 28h11.1v74H41z"/></svg>',
                // 'mode' => 'preview',
                'supports' => [
                    'align' => false,
                    'jsx' => true,
                    // 'mode' => false,
                ],
            ]);
        });
    }

    public function render($block, $content = '', $is_preview = false, $post_id = 0)
    {
        $context = Timber::get_context();

        $context['block']['heading'] = get_field('heading') ?: 'Heading';
        $context['block']['preview'] = $is_preview;

        $context['block']['template'] = esc_attr(json_encode([
            [
                'core/paragraph',
                [
                    'placeholder' => 'Start adding your content here',
                ]
            ]
        ]));

        echo Timber::compile('blocks/accordion-item.twig', $context);
    }
}
