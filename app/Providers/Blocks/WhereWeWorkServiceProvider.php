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
                'enqueue_assets' => function () {
                    wp_enqueue_script('block-where-we-work', get_template_directory_uri() . '/dist/js/block-where-we-work.js', ['manifest'], false, true);
                },
            ]);
        });
    }

    public function render()
    {
        $context = Timber::get_context();

        $context['block']['heading'] = get_field('heading');
        $context['block']['regions'] = collect(get_field('regions') ?? [])
            ->map(function ($region) {
                $region['slug'] = basename($region['link']['url']);

                return $region;
            });

        echo Timber::compile('blocks/where-we-work.twig', $context);
    }
}
