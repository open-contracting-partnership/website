<?php

namespace App;

use App\Cards\BasicCard;
use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Post;
use Timber\Timber;
use Timber\User as TimberUser;

class ArchiveController extends Controller
{
    public function handle()
    {

        // urgh
        global $wp_query;

        $context = Timber::get_context();
        $context['title'] = 'Archive';
        $context['posts'] = BasicCard::convertCollection($wp_query->posts);

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
        } elseif (is_author()) {
            $author = new TimberUser($wp_query->query_vars['author']);
            $context['title'] = 'Author Archives: ' . $author->name();
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
