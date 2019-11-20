<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

namespace App;

use App\Cards\BasicCard;
use App\Http\Controllers\Controller;
use App\PostTypes\News;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

class ArchiveController extends Controller
{
	public function handle()
	{
		$context = Timber::get_context();
		$context['title'] = 'Archive';
		$context['posts'] = BasicCard::convertCollection(Post::query());

		if (is_day()) {
			$context['title'] = 'Archive: ' . get_the_date('D M Y');
		} elseif (is_month()) {
			$context['title'] = 'Archive: ' . get_the_date('M Y');
		} elseif (is_year()) {
			$context['title'] = 'Archive: ' . get_the_date('Y');
		} elseif (is_tag()) {
			$context['title'] = 'Tag: ' . single_tag_title('', false);
		} elseif (is_category()) {
			$context['title'] = 'Category: ' . single_cat_title('', false);
		} elseif (is_post_type_archive('news')) {
			$context['title'] = _x('News', 'Archive title', 'ocp');
			$context['posts'] = BasicCard::convertCollection(News::query());
		}

		// generate the prev/next links
		$context['next_page_url'] = get_next_posts_link() ? get_next_posts_page_link() : null;
		$context['next_page_label'] = _x('Next page', 'Next and previous page links for archives', 'ocp');
		$context['previous_page_url'] = get_previous_posts_link() ? get_previous_posts_page_link() : null;
		$context['previous_page_label'] = _x('Previous page', 'Next and previous page links for archives', 'ocp');

		// set the back link
		$context['back_link'] = [
			'url' => get_post_type_archive_link('post'),
			'label' => __('Back to latest')
		];

		return new TimberResponse('templates/archive.twig', $context);
	}
}
