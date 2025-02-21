<?php

/**
 * The Template for displaying all single posts
 */

namespace App;

use App\Http\Controllers\Controller;
use App\PostTypes\Resource;
use ImLiam\ShareableLink;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

class SingleResourceController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $resource = new Resource();

        $context['resource'] = [];

        $context['resource']['title'] = $resource->title;
        $context['resource']['image_url'] = $resource->thumbnail ? $resource->thumbnail->src : null;
        $context['resource']['content'] = $resource->content;
        $context['resource']['type'] = $resource->resource_type;

        if ($context['resource']['type']) {
            $context['resource']['type'] = get_term($context['resource']['type']);
            $context['resource']['colour'] = get_field('colour', $context['resource']['type']);
        }

        $context['resource']['attachments'] = get_field('attachments', $resource->ID);
        $context['resource']['link'] = get_field('link', $resource->ID);

        if (!empty($context['resource']['attachments']) && is_array($context['resource']['attachments'])) {
            foreach ($context['resource']['attachments'] as &$attachment) {
                if (empty($attachment['name'])) {
                    $attachment['name'] = _x(
                        'Download',
                        'Default label for resource attachment download button',
                        'ocp'
                    );
                }
            }

            unset($attachment);
        }

        if ($resource->organisation) {
            $context['resource']['organisation'] = $resource->organisation;
            $context['resource']['meta'] = sprintf(__('By %s', 'ocp'), $resource->organisation) . ' / ' . $resource->date('Y');
        } else {
            $context['resource']['meta'] = $resource->date('Y');
        }

        $context['resource']['published'] = $resource->date('Y');

        // terms
        $context['resource']['taxonomies']['issue'] = $resource->issue;
        $context['resource']['taxonomies']['region'] = $resource->region;

        // for each of the taxonomies, convert the term id to a term object
        foreach ($context['resource']['taxonomies'] as $taxonomy => &$terms) {
            if (is_array($terms)) {
                $terms = array_map(function ($term) {
                    return get_term($term);
                }, $terms);
            }
        }

        $share_links = new ShareableLink($resource->link(), $resource->title);

        $context['resource']['share_links'] = array(
            'twitter' => $share_links->twitter,
            'facebook' => $share_links->facebook,
            'linkedin' => $share_links->linkedin
        );

        $context['resource']['i18n']['download_label'] = _x(
            'Download resource',
            'The download label for a resource',
            'ocp'
        );

        $context['resource']['i18n']['view_label'] = _x(
            'View resource',
            'The view label for a resource',
            'ocp'
        );

        $context['back_link'] = [
            'url' => get_post_type_archive_link('resource'),
            'label' => __('View all resources', 'ocp')
        ];

        return new TimberResponse('templates/single-resource.twig', $context);
    }
}
