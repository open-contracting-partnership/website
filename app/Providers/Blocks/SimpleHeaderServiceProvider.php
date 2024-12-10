<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class SimpleHeaderServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/simple-header',
                'title' => __('Simple Header'),
                'description' => __('A simple header for any page'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'format-image',
                'keywords' => ['simple header'],
                'supports' => [
                    'align' => false,
                    'jsx' => true,
                ]
            ]);
        });
    }

    public function render()
    {
        $context = Timber::get_context();

        $context['block'] = [];

        // content
        $context['block']['heading'] = get_field('heading') ?: 'Add primary title here&hellip;';
        $context['block']['content'] = get_field('content');


        // options
        $context['block']['options'] = get_field('options') ?: [];

        echo Timber::compile('blocks/simple-header.twig', $context);
    }
}
