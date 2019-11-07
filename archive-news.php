<?php

namespace App;

use App\Cards\BasicCard;
use App\Http\Controllers\Controller;
use App\PostTypes\News;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

class ArchiveNewsController extends Controller
{
	public function handle()
	{
		$context = Timber::get_context();
		$context['title'] = _x('News', '');

		$context['back_link'] = [
			'url' => get_post_type_archive_link('post'),
			'label' => __('Back to latest')
		];

		$context['next_page_url'] = get_next_posts_link() ? get_next_posts_page_link() : null;
		$context['next_page_label'] = _x('Next page', 'Next and previous page links for archives', 'ocp');

		$context['previous_page_url'] = get_previous_posts_link() ? get_previous_posts_page_link() : null;
		$context['previous_page_label'] = _x('Previous page', 'Next and previous page links for archives', 'ocp');

		$context['posts'] = BasicCard::convertTimberCollection(News::query());

		return new TimberResponse('templates/archive-news.twig', $context);
	}
}
