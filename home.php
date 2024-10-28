<?php

namespace App;

use App\Cards\PrimaryCard;
use App\Http\Controllers\Controller;
use App\PostTypes\Event;
use App\PostTypes\News;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Tightenco\Collect\Support\Collection;
use Timber\Post as TimberPost;
use Timber\Timber;

class HomeController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();

        $this->setPaginationContext($context);
        $this->setContentContext($context);
        $this->setFilterContext($context);
        $this->setPostsContext($context);

        // dd($context['latest']['posts']);
        // add_filter('timber_post_get_meta', function ($post_meta, $pid, $post) {
        //     $tid = get_post_thumbnail_id($pid);

        //     dump($tid);
        //     if ($tid) {
        //         $image = new $post->ImageClass($tid);
        //         $post_meta['thumbnail_url'] = $image->src;
        //     }



        //     return $post_meta;
        // }, 10, 3);

        $context['latest']['footer_latest_news'] = $this->getLatestNews(4);
        $context['latest']['footer_latest_events'] = $this->getLatestEvents(2);

        // fetch the blog content from the other page
        $blog_content_page = new TimberPost(6335);
        $context['latest']['blog_content'] = $blog_content_page->content;

        return new TimberResponse('templates/post/archive.twig', $context);
    }

    protected function setPaginationContext(&$context)
    {
        $context['pagination'] = [
            'prev' => null,
            'next' => null,
        ];

        if (get_previous_posts_link()) {
            $context['latest']['pagination']['prev'] = get_previous_posts_page_link();
        }

        if (get_next_posts_link()) {
            $context['latest']['pagination']['next'] = get_next_posts_page_link();
        }
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

        $context['latest']['content']['news_label'] = get_post_type_object('news')->labels->name;
        $context['latest']['content']['events_label'] = get_post_type_object('event')->labels->name;

        $context['latest']['content']['news_archive_link'] = [
            'url' => get_post_type_archive_link('news'),
            'label' => __('View all announcements', 'ocp')
        ];

        $context['latest']['content']['events_archive_link'] = [
            'url' => get_post_type_archive_link('event'),
            'label' => __('View all events', 'ocp')
        ];
    }

    protected function setFilterContext(&$context)
    {
        $rawFilters = collect(get_terms([
            'taxonomy' => 'issue',
        ]));

        $selectedFilters = $this->getSelectedFilters();

        $context['latest']['issues'] = collect($rawFilters)
            ->map(function ($term) use ($selectedFilters) {
                $isActive = $selectedFilters->contains($term->slug);
                $filters = clone $selectedFilters;

                if ($isActive) {
                    $filters = $filters->reject(function ($slug) use ($term) {
                        return $slug === $term->slug;
                    });
                } else {
                    $filters->push($term->slug);
                }

                return [
                    'id' => $term->term_id,
                    'name' => $term->name,
                    'slug' => $term->slug,
                    'url' => $this->buildFilterUrl($filters),
                    'is_active' => $isActive,
                ];
            });
    }

    protected function getSelectedFilters()
    {
        return collect(explode(' ', $_GET['filter'] ?? ''))
            ->filter()
            ->unique();
    }

    protected function buildFilterUrl(Collection $filters)
    {
        return sprintf(
            '%s/?%s',
            get_post_type_archive_link('post'),
            http_build_query([
                'filter' => $filters->sort()->implode(' ')
            ]
        ));
    }

    protected function setPostsContext(&$context)
    {
        $selectedFilters = $this->getSelectedFilters()->toArray();

        $query = [
            'posts_per_page' => 12,
            'paged' => get_query_var('paged') ?: 1,
        ];

        if ($selectedFilters) {
            $query['tax_query'] = [
                [
                    'taxonomy' => 'issue',
                    'field' => 'slug',
                    'terms' => $this->getSelectedFilters()->toArray(),
                ],
            ];
        }

        $posts = Timber::get_posts($query);

        $posts = PrimaryCard::convertCollection($posts, function ($new, $original) {
            $new['issues'] = collect($original->terms('issue') ?: [])
                ->pluck('slug')
                ->toArray();

            return $new;
        });

        $context['latest']['posts'] = $posts;
    }

    protected function getLatestNews($limit = 2)
    {
        return News::query([
            'posts_per_page' => $limit
        ]);
    }

    protected function getLatestEvents($limit = 1)
    {
        return Event::query([
            'posts_per_page' => $limit,
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_key' => 'event_date',
            'meta_query' => [[
                'key' => 'event_date',
                'value' => date('Ymd'),
                'compare' => '>='
            ]]
        ]);
    }
}
