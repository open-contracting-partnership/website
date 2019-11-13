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
		$context['search'] = $search;
		$context['page'] = $page;

		return new TimberResponse('templates/search.twig', $context);
	}
}
