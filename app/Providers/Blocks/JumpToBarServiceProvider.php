<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class JumpToBarServiceProvider
{

    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {

        add_action('acf/init', function () {

            acf_register_block_type([
                'name' => 'ocp/jump-to-bar',
                'title' => __('Jump-to Bar'),
                'description' => __('Add a bar to jump-to sections'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'arrow-down-alt2',
                'keywords' => ['jump', 'jump-to', 'jump to'],
                'post_types' => ['page'],
                'supports' => [
                    'align' => false
                ]
            ]);
        });
    }

    public function render()
    {

        $context = Timber::get_context();

        $context['block'] = [];
        $context['block']['title'] = get_field('title');
        $context['block']['links'] = get_field('links') ?: [];

        $context['block']['position'] = get_field('sticky') ? 'sticky' : 'fixed';

        $context['block']['background_colour'] = get_field('background_colour') ?: '#23B2A7';
        $context['block']['text_colour'] = isContrastingColourLight($context['block']['background_colour']) ? '#FFF' : '#000';
        $context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

        // options
        $context['block']['options'] = get_field('options') ?: [];
        
        echo Timber::compile('blocks/jump-to-bar.twig', $context);
    }
}
