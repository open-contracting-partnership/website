<?php

namespace App\Providers\Blocks;

use OzdemirBurak\Iris\Color\Hex;
use Timber\Timber;

class KeyIssuesServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/Key Issues',
                'title' => __('Key Issues'),
                'description' => __('A block to display key issues cards'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => '<svg height="100" width="100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0.2393 0.1548"><path class="fil0" d="M0 .0338a.0338.0338 0 11.0676 0 .0338.0338 0 01-.0676 0zM.0858.0338a.0338.0338 0 11.0676 0 .0338.0338 0 01-.0676 0zM.1717.0338a.0338.0338 0 11.0676 0 .0338.0338 0 01-.0676 0zM0 .121a.0338.0338 0 11.0676 0A.0338.0338 0 010 .121zM.0858.121a.0338.0338 0 11.0676 0 .0338.0338 0 01-.0676 0zM.1717.121a.0338.0338 0 11.0676 0 .0338.0338 0 01-.0676 0z"/></svg>',
                'keywords' => ['key-issues'],
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
        $context['block']['introduction'] = get_field('introduction');
        $context['block']['key_issues'] = [];

        // Loop through 'key_issues' repeater field
        if (have_rows('key_issues')) {
            while (have_rows('key_issues')) {
                the_row();
                $context['block']['key_issues'][] = [
                    'icon' => get_sub_field('icon'),
                    'issue_name' => get_sub_field('issue_name')
                ];
            }
        }

        $context['block']['background_colour'] = get_field('background_colour') ?: '#23B2A7';
        $context['block']['text_colour'] = isContrastingColourLight($context['block']['background_colour']) ? '#FFF' : '#000';
        $context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

        $context['block']['options'] = get_field('options') ?: [];

        echo Timber::compile('blocks/key-issues.twig', $context);
    }
}
