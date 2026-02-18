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
