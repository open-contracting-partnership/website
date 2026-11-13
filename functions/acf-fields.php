<?php

/**
 * Adds various sub-options pages
 */

if (function_exists('acf_add_options_page') && function_exists('acf_add_options_sub_page')) {
    // add parent
    $parent = acf_add_options_page([
        'page_title' => 'Options',
        'menu_title' => 'Options',
        'redirect' => true
    ]);

    // add sub page
    acf_add_options_sub_page([
        'page_title' => 'Sticky CTA',
        'menu_title' => 'Sticky CTA',
        'parent_slug' => $parent['menu_slug'],
    ]);

    // add sub page
    acf_add_options_sub_page([
        'page_title' => 'Navigation',
        'menu_title' => 'Navigation',
        'parent_slug' => $parent['menu_slug'],
    ]);

    // add sub page
    acf_add_options_sub_page([
        'page_title' => 'Resources',
        'menu_title' => 'Resources',
        'parent_slug' => $parent['menu_slug'],
    ]);
}

 //*****************
// GUTENBERG BLOCKS

add_filter('block_categories_all', function ($categories, $post) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'ocp-blocks',
                'title' => 'OCP Blocks'
            ),
        )
    );
}, 10, 2);
