<?php

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Timber\Post as TimberPost;
use Timber\Timber;

class HomeController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();

        $this->setContentContext($context);

        // fetch the blog content from the other page
        $blog_content_page = new TimberPost(6335);
        $context['latest']['blog_content'] = $blog_content_page->content;

        return new TimberResponse('templates/post/archive.twig', $context);
    }

    protected function setContentContext(&$context)
    {
        $posts_page_id = (int) get_option('page_for_posts');

        $context['latest']['content']['heading'] = get_field('heading', $posts_page_id);
        $context['latest']['content']['content'] = get_field('content', $posts_page_id);

        $context['latest']['content']['load_more'] = _x(
            'Load more',
            'The load more posts label for the latest news',
            'ocp'
        );
    }
}
