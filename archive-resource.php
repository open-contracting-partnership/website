<?php

namespace App;

use App\Http\Controllers\Controller;
use App\PostTypes\Resource;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Timber\Timber;

class ArchiveResourceController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $context['title'] = _x('Search our resources', 'Resources archive title', 'ocp');

        $context['resource_library_filters'] = get_field('resources_filters', 'options');
        $context['block']['heading'] = get_field('resources_heading', 'options');
        $context['block']['content'] = get_field('resources_content', 'options');

        $context['resources_output'] = $this->getAllResources();

        if ($context['resource_library_filters']) {
            foreach ($context['resource_library_filters'] as &$filter_group) {
                $filter_group['filter'] = array_map(function ($filter) {

                    $term = get_term($filter['type']);

                    $filter['slug'] = $term->slug;
                    $filter['taxonomy'] = $term->taxonomy;
                    $filter['label'] = $term->name;
                    $filter['colour'] = get_field('colour', $term);

                    return $filter;
                }, $filter_group['filter']);
            }
        }

        $context['resources']['i18n']['introduction'] = _x(
            'We are constantly preparing new resources to help you implement open contracting more effectively and efficiently. Whether it’s guides and research developed by us and our partners, or our data tools and training materials, we have it listed.',
            'The introduction on the resources archive',
            'ocp'
        );

        $context['resources']['i18n']['no_results_label'] = _x(
            'No results found',
            'The no results found label on the resources archive',
            'ocp'
        );

        // localise the script only *after* the scripts are queued up
        add_action('wp_enqueue_scripts', function () {
            wp_localize_script('archive-resource', 'content', [
                'resources' => $this->getAllResources(),
                'select_a_filter' => str_replace(' ', '&nbsp;', __('Select a topic', 'ocp'))
            ]);
        });

        return new TimberResponse('templates/archive-resource.twig', $context);
    }

    private function getAllResources()
    {

        $resources_output = [];

        $resources = Resource::query([
            'posts_per_page' => -1
        ]);

        foreach ($resources as $resource) {
            $output = [];
            $output['date'] = $resource->date('c');
            $output['title'] = $resource->title;
            $output['url'] = $resource->link();
            $output['image'] = get_the_post_thumbnail();
            $output['excerpt'] = wp_trim_words($resource->post_content, 15);

            if ($resource->organisation) {
                $output['meta'] = sprintf(__('By %s', 'ocp'), $resource->organisation) . ' / ' . $resource->date('Y');
            } else {
                $output['meta'] = $resource->date('Y');
            }

            $output['type'] = null;
            $output['type_label'] = null;
            $output['is_featured'] = $resource->meta('resource_is_featured') ?? false;

            if ($resource->resource_type) {
                $term = get_term($resource->resource_type);

                $output['type'] = $term->slug;
                $output['type_label'] = $term->name;
                $output['colour'] = get_field('colour', $term);
            }

            $resources_output[] = $output;
        }

        $resources_output = collect($resources_output)
            ->map(function ($resource) {
                $resource['card'] = Timber::compile('cards/resource.twig', [
                    'card' => $resource,
                    'options' => [
                        'colour_scheme' => 'light'
                    ]
                ]);
                return $resource;
            })
            ->toArray();

        return $resources_output;
    }

}
