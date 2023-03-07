<?php

namespace App\Providers\Blocks;

use App\Cards\ResourceCard;
use Timber\Timber;

class ResourceServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/resource',
                'title' => __('Resource'),
                'description' => __('Display a range of resources'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'grid-view',
                'keywords' => ['resource', 'resources'],
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

        $context['block']['title'] = get_field('title') ?: 'Title here...';
        $context['block']['content'] = get_field('content');
        $context['block']['resources_title'] = get_field('resources_title');
        $context['block']['contact'] = get_field('contact') ? get_field('contact')[0] : [];
        $context['block']['sidebar_links'] = array_column(get_field('sidebar_links') ?: [], 'link');
        $context['block']['resources'] = [];

        if ($resources = get_field('resources')) {
            foreach ($resources as $resource) {
                $context['block']['resources'][] = ResourceCard::convertPost($resource->ID);
            }
        }

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

        echo Timber::compile('blocks/resource.twig', $context);
    }
}
