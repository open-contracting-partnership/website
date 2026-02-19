<?php

use App\Assets;
use App\Models\News;

add_action('wp_enqueue_scripts', function () {

    //****************
    // REGISTER ASSETS

    // BASE
    Assets::registerStyle('main', 'resources/scss/styles.scss');
    Assets::registerScript('main', 'resources/js/scripts.js', true);
    Assets::registerScript('header', 'resources/js/header.js', true);
    Assets::registerScript('element-queries', 'resources/js/element-queries.js', true);

    // SPECIFIC
    Assets::registerScript('page-impact-stories', 'resources/js/impact-stories.js', true);
    Assets::registerScript('latest-news', 'resources/js/latest-news.js', true);
    Assets::registerScript('archive-resource', 'resources/js/archive-resource.js', true);
    Assets::registerScript('page-worldwide', 'resources/js/modules/worldwide/worldwide.js', true);

    // BLOCKS
    Assets::registerScript('block-download-carousel', 'resources/js/block-download-carousel.js', true);
    Assets::registerScript('block-featured-stories-carousel', 'resources/js/block-featured-stories-carousel.js', true);
    Assets::registerScript('block-our-model', 'resources/js/block-our-model.js', true);
    Assets::registerScript('block-quote-carousel', 'resources/js/block-quote-carousel.js', true);
    Assets::registerScript('block-stats', 'resources/js/block-stats.js', true);
    Assets::registerScript('block-team-profile', 'resources/js/block-team-profile.js', true);
    Assets::registerScript('block-timeline', 'resources/js/block-timeline.js', true);
    Assets::registerScript('block-where-we-work', 'resources/js/block-where-we-work.js', true);

    // MISCELLANEOUS
    Assets::registerScript('mailchimp', 'resources/js/mailchimp.js', true);
    Assets::registerScript('scroll-prompt', 'resources/js/scroll-prompt.js', true);

    //************
    // LOAD ASSETS

    wp_enqueue_style('main');
    wp_enqueue_script('main');
    wp_enqueue_script('header');
    wp_enqueue_script('element-queries');

    // impact stories
    if (basename(get_page_template()) === 'page-impact-stories.php') {
        wp_enqueue_script('page-impact-stories');
    }

    if (is_home()) {
        wp_localize_script('latest-news', 'latest_news_content', [
            'posts' => News::getPosts(),
            'filters' => News::getFilters(),
        ]);

        wp_enqueue_script('latest-news');
    }

    if (is_post_type_archive('resource')) {
        wp_enqueue_script('archive-resource');
    }

    // WORLDWIDE
    if (basename(get_page_template()) === 'page-worldwide.php') {
        wp_enqueue_script('page-worldwide');
    }
});
