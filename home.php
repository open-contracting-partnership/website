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

use App\Cards\FeatureCard;
use App\Cards\PrimaryCard;
use App\Http\Controllers\Controller;
use App\PostTypes\Event;
use App\PostTypes\News;
use App\PostTypes\Resource;
use Rareloop\Lumberjack\Facades\Config;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Post;
use Timber\Post as TimberPost;
use Timber\Timber;

class HomeController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();

        $context['latest']['content']['title'] = _x(
            'More blogs about open contracting and',
            'Displayed within the latest news, proceeded by a separate string, "select a topic"',
            'ocp'
        );

        $context['latest']['content']['filter_label'] = _x(
            'Select a topic',
            'The topic filter label within the latest news',
            'ocp'
        );

        $context['latest']['content']['load_more'] = _x(
            'Load more',
            'The load more posts label for the latest news',
            'ocp'
        );

        $context['latest']['content']['featured_label'] = _x(
            'Featured',
            'The featured blog label',
            'ocp'
        );

        $context['latest']['content']['news_label'] = get_post_type_object('news')->labels->name;
        $context['latest']['content']['events_label'] = get_post_type_object('event')->labels->name;
        $context['latest']['content']['resources_label'] = get_post_type_object('resource')->labels->name;

        $context['issue_terms'] = get_terms([
            'taxonomy' => 'issue',
        ]);

        // localise the script only *after* the scripts are queued up
        add_action('wp_enqueue_scripts', function () {

            wp_localize_script('latest-news', 'content', [
                'posts' => $this->getBlogs(),
                'select_a_filter' => str_replace(' ', '&nbsp;', __('Select a topic', 'ocp')),
                'imgix_host_transforms' => Config::get('images.imgix_host_transforms')
            ]);
        });

        add_filter('timber_post_get_meta', function ($post_meta, $pid, $post) {

            $tid = get_post_thumbnail_id($pid);

            if ($tid) {
                $image = new $post->ImageClass($tid);
                $post_meta['thumbnail_url'] = $image->src;
            }

            return $post_meta;
        }, 10, 3);

        $context['latest']['featured_blog'] = $this->getFeaturedBlog();

        $context['latest']['news_archive_link'] = [
            'url' => get_post_type_archive_link('news'),
            'label' => __('View all news', 'ocp')
        ];

        $context['latest']['events_archive_link'] = [
            'url' => get_post_type_archive_link('event'),
            'label' => __('View all events', 'ocp')
        ];

        $context['latest']['resources_archive_link'] = [
            'url' => get_post_type_archive_link('resource'),
            'label' => __('View all resources', 'ocp')
        ];

        $context['latest']['header_latest_news'] = $this->getLatestNews(2);
        $context['latest']['footer_latest_news'] = $this->getLatestNews(4);

        $context['latest']['header_latest_events'] = $this->getLatestEvents(1);
        $context['latest']['footer_latest_events'] = $this->getLatestEvents(2);

        $context['latest']['footer_latest_resources'] = $this->getLatestResources(4);

        // fetch the blog content from the other page
        $blog_content_page = new TimberPost(6335);
        $contex['latest']['blog_content'] = $blog_content_page->content;

        return new TimberResponse('templates/home.twig', $context);
    }

    protected function getBlogs()
    {

        $posts = Post::query([
            'ignore_sticky_posts' => true,
            'posts_per_page' => -1
        ]);

        // convert and filter the
        $posts = PrimaryCard::convertCollection($posts, function ($new, $original) {

            // we don't want to show a button label
            unset($new['button_label']);

            // and we want the lighter colour scheme, we set this on the card as
            // with vue we don't currently set this any other way

            $new['colour_scheme'] = 'light';

            $issues = $original->terms('issue') ?: [];

            $issues = array_map(function ($term) {
                return $term->id;
            }, $issues);

            // add issue terms to post
            $new['issue'] = $issues;

            return $new;
        });

        return $posts;
    }

    protected function getFeaturedBlog()
    {
        $query = [
            'post_type' => 'post',
            'posts_per_page' => 1
        ];

        if ($postID = get_field('featured_news_article', 'options')) {
            $query['p'] = $postID;
        }

        $featured_blog = Post::query($query);

        if (count($featured_blog)) {
            return ['card' => FeatureCard::convertPost($featured_blog[0]->ID)];
        }
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

    protected function getLatestResources($limit = 2)
    {

        return Resource::query([
            'posts_per_page' => $limit
        ]);
    }
}
