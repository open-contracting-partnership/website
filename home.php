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
        $this->setFilterContext($context);

        // fetch the blog content from the other page
        $blog_content_page = new TimberPost(6335);
        $context['latest']['blog_content'] = $blog_content_page->content;

        return new TimberResponse('templates/post/archive.twig', $context);
    }

    protected function setContentContext(&$context)
    {
        $context['latest']['content']['heading'] = get_field('announcements_heading', 'options');
        $context['latest']['content']['content'] = get_field('announcements_content', 'options');

        $context['latest']['content']['load_more'] = _x(
            'Load more',
            'The load more posts label for the latest news',
            'ocp'
        );
    }

    protected function setFilterContext(&$context)
    {
        $context['latest']['issues'] = collect(get_terms([
                'taxonomy' => 'issue',
            ]))
            ->map(function ($term) {
                return [
                    'id' => $term->term_id,
                    'name' => $term->name,
                    'slug' => $term->slug,
                ];
            });
    }
}
