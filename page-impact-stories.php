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

        $context['countries'] = [];
        $context['story_types'] = [];

        // compile the countries and story types
        foreach ($context['stories'] as $story) {
            foreach ($story['country'] as $country) {
                $context['countries'][$country->id] = $country->name;
            }

            foreach ($story['story_type'] as $story_type) {
                $context['story_types'][$story_type->id] = $story_type->name;
            }
        }

        // sort the countries and story types
        asort($context['countries']);
        asort($context['story_types']);

        // bring the country and story ids into their own array
        $context['stories'] = array_map(function ($story) {

            // fetch just the id from the country and types
            $story['country_ids'] = array_column($story['country'], 'id');
            $story['story_type_ids'] = array_column($story['story_type'], 'id');

            // for the sake of vue, make them a string first
            $story['country_ids'] = array_map('strval', $story['country_ids']);
            $story['story_type_ids'] = array_map('strval', $story['story_type_ids']);

            return $story;
        }, $context['stories']);

        // filter just the featured stories
        $context['featured_stories'] = array_filter($context['stories'], function ($story) {
            return $story['featured'];
        });

        // match the featured stories with the correct card type
        $context['featured_stories'] = array_map(function ($story) {

            return [
                'title' => $story['title'],
                'introduction' => $story['introduction'],
                'image_url' => $story['image']['url'],
                'url' => $story['link']
            ];
        }, $context['featured_stories']);

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

        return new TimberResponse('templates/impact-stories.twig', $context);
    }
}
