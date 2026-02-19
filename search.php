<?php

/**
 * Search results page
 */

namespace App;

use App\Cards\BasicCard;
use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Timber\Timber;

class SearchController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $search_query = trim(get_search_query());

        $context['title'] = 'Search results for \'' . htmlspecialchars($search_query) . '\'';

        $context['search']['order_by'] = $_GET['orderby'] ?? 'relevance';

        $context['search']['sort_links'] = [
            'recent' => sprintf(
                '%s?s=%s&orderby=post_date&order=desc',
                get_bloginfo('url'),
                get_search_query(),
            ),
            'relevance' => sprintf(
                '%s?s=%s&orderby=relevance',
                get_bloginfo('url'),
                get_search_query(),
            ),
        ];

        $context['search']['i18n']['next_page_label'] = _x(
            'Next Page',
            'The next page label on search results',
            'ocp'
        );

        $context['search']['i18n']['no_results_label'] = _x(
            'No results found.',
            'The no results found label on search results',
            'ocp'
        );

        global $wp_query;

        $context['search']['results'] = BasicCard::convertCollection(
            $wp_query->posts,
            function ($post) {
                $post['show_excerpt'] = true;

                return $post;
            }
        );

        $context['search']['pagination'] = Timber::get_pagination();

        return new TimberResponse('templates/search.twig', $context);
    }
}
