<?php

namespace App;

use App\Cards\EventCard;
use App\Http\Controllers\Controller;
use App\PostTypes\Resource;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

class ArchiveResourceController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $context['title'] = _x('Search our resources', 'Resources archive title', 'ocp');

        $context['resource_library_filters'] = get_field('resources_filters', 'options');

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

        $context['learning_library_filters'] = get_field('learning_library_filters', 'options');

        if ($context['learning_library_filters']) {
            foreach ($context['learning_library_filters'] as &$filter_group) {
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

            if ($resource->organisation) {
                $output['meta'] = sprintf(__('By %s', 'ocp'), $resource->organisation) . ' / ' . $resource->date('Y');
            } else {
                $output['meta'] = $resource->date('Y');
            }

            $output['type'] = null;
            $output['type_label'] = null;

            $output['location'] = $resource->resource_location ?? [];

            $output['is_featured'] = $resource->meta('resource_is_featured') ?? false;

            $output['learning_resource_category'] = null;
            $output['learning_resource_category_label'] = null;

            if ($resource->resource_type) {
                $term = get_term($resource->resource_type);

                $output['type'] = $term->slug;
                $output['type_label'] = $term->name;
                $output['colour'] = get_field('colour', $term);
            }

            if ($resource->learning_resource_category) {
                $term = get_term($resource->learning_resource_category);

                $output['learning_resource_category'] = $term->slug;
                $output['learning_resource_category_label'] = $term->name;
            }

            $resources_output[] = $output;
        }

        return $resources_output;
    }
}
