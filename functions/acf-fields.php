<?php // functions/acf-fields.php

/**
 * Adds various sub-options pages
 */

if ( function_exists('acf_add_options_page') && function_exists('acf_add_options_sub_page') ) {

	// add parent
	$parent = acf_add_options_page([
		'page_title' => 'Options',
		'menu_title' => 'Options',
		'redirect' => true
	]);

	// add sub page
	acf_add_options_sub_page([
		'page_title' => 'Header',
		'menu_title' => 'Header',
		'parent_slug' => $parent['menu_slug'],
	]);

}

add_filter('acf/load_field/key=field_5da4546ef870e', function($field) {

	// Get all locations
	$locations = get_nav_menu_locations();

	// Get object id by location
	$object = wp_get_nav_menu_object($locations['main-nav']);

	// Get menu items by menu name
	$menu_items = wp_get_nav_menu_items( $object->name );

	$menu_items = array_filter($menu_items, function($menu_item) {
		return $menu_item->menu_item_parent == 0;
	});

	$options = array();

	foreach ( $menu_items as $menu_item ) {
		$options[$menu_item->ID] = $menu_item->title;
	}

	// reset choices
	$field['choices'] = $options;

	// return the field
	return $field;

});


 //*****************
// GUTENBERG BLOCKS

add_filter( 'block_categories', function($categories, $post) {

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

add_action('acf/init', function() {

	// register a testimonial block.
	acf_register_block_type([
		'name' => 'stories',
		'title' => __('Stories'),
		'description' => __('A block to display stories'),
		'render_template' => 'partials/blocks/stories.php',
		'category' => 'ocp-blocks',
		'icon' => 'welcome-widgets-menus',
		'keywords' => ['story', 'stories']
	]);

});
