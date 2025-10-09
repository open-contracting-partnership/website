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

    // add sub page
    acf_add_options_sub_page([
        'page_title' => 'News and Blogs',
        'menu_title' => 'News and Blogs',
        'parent_slug' => $parent['menu_slug'],
    ]);
}

// populate the ACF mega menu "parent" field with real menu items
add_filter('acf/load_field/key=field_60646cab36b7e', function ($field) {
    // Get all locations
    $locations = get_nav_menu_locations();

    if (! isset($locations['header-primary-nav'])) {
        return $field;
    }

    // Get object id by location
    $object = wp_get_nav_menu_object($locations['header-primary-nav']);

    // Get menu items by menu name
    $menu_items = wp_get_nav_menu_items($object->name);

    $menu_items = array_filter($menu_items, function ($menu_item) {
        return $menu_item->menu_item_parent == 0;
    });

    $options = array();

    foreach ($menu_items as $menu_item) {
        $options[$menu_item->ID] = $menu_item->title;
    }

    // reset choices
    $field['choices'] = $options;

    // return the field
    return $field;
});


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
