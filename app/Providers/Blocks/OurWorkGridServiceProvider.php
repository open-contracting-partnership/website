<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class OurWorkGridServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/our-work-grid',
                'title' => __('Our Work Grid'),
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

    public function render(array $block, string $content = '', bool $is_preview = false, int $post_id = 0): void
    {
        $context = Timber::get_context();

        $context['block']['heading'] = get_field('heading');
        $context['block']['strapline'] = get_field('strapline');
        $context['block']['previous_block_colour'] = get_field('previous_block_colour');
        $context['block']['cards'] = get_field('cards');
        $context['block']['preview'] = $is_preview;

        Timber::render('blocks/our-work-grid.twig', $context);
    }
}
