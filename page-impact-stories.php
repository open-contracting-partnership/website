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

        $context['title'] = $page->title();
        $context['content'] = $page->content;

        $context['latest_stories']['stories'] = collect(get_field('add_stories', get_the_ID()))
            ->map(function ($story, $index) {
                // 1. normalise taxonomy fields
                $story['country'] = $story['country'] ?: [];
                $story['story_type'] = $story['story_type'] ?: [];
                $story['issues'] = [];

                // 2. fetch the issues
                $postID = url_to_postid($story['link']);

                if ($postID !== 0) {
                    $story['issues'] = wp_get_object_terms($postID, 'issue');
                }

                // 3. compile json array of term ids for vue filtering
                $story['attributes'] = [
                    'ref' => 'story-' . $index,
                    'data-country-ids' => $this->getStoryTermIDs($story['country']),
                    'data-story-type-ids' => $this->getStoryTermIDs($story['story_type']),
                    'data-issue-ids' => $this->getStoryTermIDs($story['issues']),
                ];

                // 4. card related data transformations
                $story['image_url'] = $story['image'] ? $story['image']['url'] : null;

                if ($story['story_type']) {
                    $story['type_label'] = $story['story_type'][0]->name;
                }

                $story['url'] = $story['link'];

                return $story;
            });

        // compile taxomony lists
        $context['impact_stories']['terms']['countries'] = $this->getTerms($context['latest_stories']['stories'], 'country');
        $context['impact_stories']['terms']['story_types'] = $this->getTerms($context['latest_stories']['stories'], 'story_type');
        $context['impact_stories']['terms']['issues'] = $this->getTerms($context['latest_stories']['stories'], 'issues');

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

    protected function getTerms($stories, $taxonomy)
    {
        return $stories
            ->pluck($taxonomy)
            ->flatten()
            ->unique('term_id')
            ->sortBy('name')
            ->mapWithKeys(function ($country) {
                return [$country->term_id => $country->name];
            });
    }

    protected function getStoryTermIDs($terms)
    {
        $storyTermIDs = collect($terms)
            ->pluck('term_id')
            ->map(fn ($termID) => strval($termID))
            ->values();

        return htmlspecialchars(json_encode($storyTermIDs));
    }
}
