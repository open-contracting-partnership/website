<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class FeaturedStoriesCarouselServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/featured-stories-carousel',
                'title' => __('Featured Stories Carousel'),
                // 'description' => __('Add content.'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'format-gallery',
                'enqueue_assets' => function () {
                    wp_enqueue_script('block-featured-stories-carousel');
                },
                'keywords' => ['featured', 'story', 'stories', 'carousel'],
                'post_types' => ['page', 'post'],
                'supports' => [
                    'align' => false
                ]
            ]);
        });
    }

    public function render(): void
    {
        $context = Timber::get_context();

        $context['block'] = [];
        $context['block']['featured_stories'] = get_field('featured_stories') ?: [];

        // match the featured stories with the correct card type
        $context['block']['featured_stories'] = array_map(function ($story) {

            return [
                'title' => $story['link']['title'] ?? null,
                'introduction' => $story['introduction'],
                'image_url' => $story['image']['url'],
                'url' => $story['link']['url'] ?? null
            ];
        }, $context['block']['featured_stories']);

        // options
        $context['block']['options'] = get_field('options') ?: [];
        $context['block']['options']['show_overlay'] = get_field('show_overlay') ?? true;

        Timber::render('blocks/featured-stories-carousel.twig', $context);
    }
}
