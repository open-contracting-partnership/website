<?php

use App\Assets;

add_action('wp_enqueue_scripts', function () {

    Assets::registerScript('manifest', '/dist/js/manifest.js', [], true);
    Assets::registerScript('vendor', '/dist/js/vendor.js', [], true);

     //****************
    // REGISTER ASSETS

    // EXTRACTED
    Assets::registerScript('manifest', '/dist/js/manifest.js', [], true);
    Assets::registerScript('vendor', '/dist/js/vendor.js', [], true);

    // BASE
    Assets::registerStyle('main', '/dist/css/styles.css');
    Assets::registerScript('main', '/dist/js/scripts.js', ['manifest'], true);
    Assets::registerScript('header', '/dist/js/header.js', ['manifest'], true);
    Assets::registerScript('element-queries', '/dist/js/element-queries.js', [], true);

    // SPECIFIC
    Assets::registerScript('page-impact-stories', '/dist/js/impact-stories.js', ['manifest', 'vendor'], true);
    Assets::registerScript('archive-resource', '/dist/js/archive-resource.js', ['manifest', 'vendor'], true);
    Assets::registerScript('page-worldwide', '/dist/js/worldwide.js', ['manifest', 'vendor'], true);


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

    if (is_post_type_archive('resource')) {
        wp_enqueue_script('archive-resource');
    }

    // WORLDWIDE
    if (basename(get_page_template()) === 'page-worldwide.php') {
        wp_enqueue_script('page-worldwide');
    }
});
