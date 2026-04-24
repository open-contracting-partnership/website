<?php

use App\Assets;
use App\Models\News;
use App\PostTypes\Resource;
use Rareloop\Lumberjack\Facades\Config;
use Rareloop\Lumberjack\Page;

add_filter('script_module_data_archive-resource', function ($data) {
    $data['resources'] = Resource::getAllResources();
    $data['select_a_filter'] = str_replace(' ', '&nbsp;', __('Select a topic', 'ocp'));

    return $data;
});

add_filter('script_module_data_page-worldwide', function ($data) {
    $data['mapbox_access_token'] = Config::get('services.mapbox_access_token');

    $page = new Page();

    $data['content'] = [
        'title' => $page->meta('heading'),
        'content' => $page->meta('introduction'),
        'table_view' => __('Table view', 'ocp'),
        'map_view' => __('Map view', 'ocp'),
        'map' => array(
            'filter' => __('Filter Options', 'ocp'),
            'close' => __('Close Filter', 'ocp'),
        ),
        'filter' => array(
            'all' => __('Active countries', 'ocp'),
            'ocds' => __('Using the Open Contracting Data Standard', 'ocp'),
            'ocds_status' => __('Status:', 'ocp'),
            'ocds_ongoing' => __('Ongoing', 'ocp'),
            'ocds_implementation' => __('Implementation', 'ocp'),
            'ocds_historic' => __('Historic', 'ocp'),
            'commitments' => __('With documented commitments', 'ocp'),
            'contract' => __('With innovation in contracting monitoring & data use', 'ocp'),
        ),
        'country' => array(
            'ocds' => __('Using the Open Contracting Data Standard', 'ocp'),
            'commitments' => __('Documented commitments', 'ocp'),
            'contract' => __('Innovation in contract monitoring & data use', 'ocp'),
            'impact_stories' => __('Impact Stories', 'ocp'),
            'no_data' => __('No data available', 'ocp'),
            'improve_data' => __('Improve this data', 'ocp'),
        ),
        'search' => array(
            'placeholder' => __('Find Country', 'ocp'),
            'no_data' => __('(No data yet)', 'ocp')
        )
    ];

    return $data;
});

add_filter('script_module_data_latest-news', function ($data) {
    $data['posts'] = News::getPosts();
    $data['filters'] = News::getFilters();

    return $data;
});

add_filter('script_module_data_mailchimp', function ($data) {
    $data['root'] = esc_url_raw(rest_url());
    $data['error_text'] = __('An error occured, try again later.', 'ocp');

    return $data;
});

add_filter('script_module_data_block-team-profile', function ($data) {
    $data['is_admin'] = is_admin();

    return $data;
});

add_action('wp_enqueue_scripts', function () {
    //****************
    // REGISTER ASSETS

    // BASE
    Assets::registerStyle('main', 'css/styles-VITE.css');
    Assets::registerScript('main', 'js/scripts-VITE.js', true);
    Assets::registerScript('header', 'js/header-VITE.js', true);
    Assets::registerScript('sticky-cta', 'js/sticky-cta-VITE.js', true);

    // SPECIFIC
    Assets::registerScript('page-impact-stories', 'js/impact-stories-VITE.js', true);
    Assets::registerScript('latest-news', 'js/latest-news-VITE.js', true);
    Assets::registerScript('archive-resource', 'js/archive-resource-VITE.js', true);

    Assets::registerStyle('page-worldwide', 'css/worldwide-VITE.css');
    Assets::registerScript('page-worldwide', 'js/worldwide-VITE.js', true);

    // BLOCKS
    Assets::registerScript('block-download-carousel', 'js/block-download-carousel-VITE.js', true);
    Assets::registerScript('block-featured-stories-carousel', 'js/block-featured-stories-carousel-VITE.js', true);
    Assets::registerScript('block-our-model', 'js/block-our-model-VITE.js', true);
    Assets::registerScript('block-quote-carousel', 'js/block-quote-carousel-VITE.js', true);
    Assets::registerScript('block-stats', 'js/block-stats-VITE.js', true);
    Assets::registerScript('block-team-profile', 'js/block-team-profile-VITE.js', true);
    Assets::registerScript('block-timeline', 'js/block-timeline-VITE.js', true);
    Assets::registerScript('block-where-we-work', 'js/block-where-we-work-VITE.js', true);

    // MISCELLANEOUS
    Assets::registerScript('mailchimp', 'js/mailchimp-VITE.js', true);
    Assets::registerScript('scroll-prompt', 'js/scroll-prompt-VITE.js', true);

    //************
    // LOAD ASSETS

    wp_enqueue_style('main');
    wp_enqueue_script_module('main');
    wp_enqueue_script_module('header');
    wp_enqueue_script_module('sticky-cta');

    // impact stories
    if (basename(get_page_template()) === 'page-impact-stories.php') {
        wp_enqueue_script_module('page-impact-stories');
    }

    if (is_home()) {
        wp_enqueue_script_module('latest-news');
    }

    if (is_post_type_archive('resource')) {
        wp_enqueue_script_module('archive-resource');
    }

    // WORLDWIDE
    if (basename(get_page_template()) === 'page-worldwide.php') {
        wp_enqueue_style('page-worldwide');
        wp_enqueue_script_module('page-worldwide');
    }
});
