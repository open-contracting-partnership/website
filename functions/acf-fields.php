<?php // functions/acf-fields.php

/**
 * Adds various sub-options pages
 */

if ( TRUE ) {

	if ( function_exists('acf_add_options_sub_page') ) {
		acf_add_options_sub_page('Options');
	}

}


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
