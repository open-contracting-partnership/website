<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class WhereWeWorkServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/where-we-work',
                'title' => __('Where We Work'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'supports' => [
                    'align' => false,
                ],
            ]);
        });
    }

    public function render()
    {
        $context = Timber::get_context();

        $context['block']['heading'] = get_field('heading');
        $context['block']['regions'] = get_field('regions');

        echo Timber::compile('blocks/where-we-work.twig', $context);
    }
}
