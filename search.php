<?php
/**
 * Search results page
 */

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Post;
use Timber\Timber;
use App\Search;

class SearchController extends Controller
{
	public function handle()
	{
		$context = Timber::get_context();
		$search_query = get_search_query();

		$page = get_query_var('page', 1);
		$search = new Search($search_query, $page);

		$context['title'] = 'Search results for \''.htmlspecialchars($search_query).'\'';
		$context['search']['results'] = $search;

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

		$context['page'] = $page;

		return new TimberResponse('templates/search.twig', $context);
	}
}
