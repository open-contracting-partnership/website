<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Page;
use Timber\Timber;

class PageImpactStoriesController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $page = new Page();

        $context['title'] = $page->title;
        $context['content'] = $page->content;
        $context['stories'] = $page->meta('add_stories');
        $context['stories'] = get_field('add_stories', get_the_ID());

        $context['countries'] = [];
        $context['story_types'] = [];
        $context['issues'] = [];

        // compile the countries and story types
        foreach ($context['stories'] as &$story) {
            foreach ($story['country'] as $country) {
                $context['countries'][$country->term_id] = $country->name;
            }

            if (! \is_array($story['story_type'])) {
                $story['story_type'] = [];
            }

            $story['issues'] = [];

            foreach ($story['story_type'] as $story_type) {
                $context['story_types'][$story_type->term_id] = $story_type->name;
            }

            $postID = url_to_postid($story['link']);

            if ($postID !== 0) {
                $story['issues'] = wp_get_object_terms($postID, 'issue');

                foreach ($story['issues'] as $storyIssue) {
                    $context['issues'][$storyIssue->term_id] = $storyIssue->name;
                }
            }
        }

        // sort the countries and story types
        asort($context['countries']);
        asort($context['story_types']);
        asort($context['issues']);

        // bring the country and story ids into their own array
        $context['stories'] = array_map(function ($story) {

            // fetch just the id from the country and types
            $story['country_ids'] = array_column($story['country'], 'term_id');
            $story['story_type_ids'] = array_column($story['story_type'], 'term_id');
            $story['issue_ids'] = array_column($story['issues'], 'term_id');

            // for the sake of vue, make them a string first
            $story['country_ids'] = array_map('strval', $story['country_ids']);
            $story['story_type_ids'] = array_map('strval', $story['story_type_ids']);
            $story['issue_ids'] = array_map('strval', $story['issue_ids']);

            return $story;
        }, $context['stories']);

        $context['impact_stories']['i18n']['story_types_label'] = _x(
            'Story Types',
            'The story types label on impact stories',
            'ocp'
        );

        $context['impact_stories']['i18n']['countries_label'] = _x(
            'Countries',
            'The countries label on impact stories',
            'ocp'
        );

        $context['impact_stories']['i18n']['issues_label'] = _x(
            'Issues',
            'The issues label on impact stories',
            'ocp'
        );

        $context['impact_stories']['i18n']['no_results_label'] = _x(
            'There are no results that match your search.',
            'The no results label on impact stories',
            'ocp'
        );

        return new TimberResponse('templates/impact-stories.twig', $context);
    }
}
