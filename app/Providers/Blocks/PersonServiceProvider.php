<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class PersonServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/person',
                'title' => __('Person'),
                'description' => __('Display a person with their contact details'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'admin-users',
                'keywords' => ['person'],
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
        $context['block']['contact'] = get_field('contact') ? get_field('contact')[0] : [];

        if ($context['block']['contact']) {
            $context['block']['contact']['name_bio'] = implode(', <br/>', [
                $context['block']['contact']['name'],
                $context['block']['contact']['role']
            ]);
        }

        $context['block']['background_colour'] = get_field('background_colour') ?: '#6C75E1';
        $context['block']['text_colour'] = isContrastingColourLight($context['block']['background_colour']) ? '#FFF' : '#000';
        $context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

        // options
        $context['block']['options'] = get_field('options') ?: [];

        echo Timber::compile('blocks/person.twig', $context);
    }
}
