<?php // functions/acf-fields.php

/**
 * Adds various sub-options pages
 */

if ( TRUE ) {

	if ( function_exists('acf_add_options_sub_page') ) {
		acf_add_options_sub_page('Blog');
	}

}


 //****************
// CUSTOM LOCATION

/*

add_filter('acf/location/rule_types', function($choices) {

	$choices['Supports']['supports'] = 'Post Type Support';

	return $choices;

});

add_filter('acf/location/rule_values/supports', function($choices) {

	$choices = array_merge($choices, [
		'title' => 'Title',
		'editor' => 'Editor',
		'author' => 'Author',
		'thumbnail' => 'Thumbnail',
		'excerpt' => 'Excerpt',
		'trackbacks' => 'Trackbacks',
		'custom-fields' => 'Custom Fields',
		'comments' => 'Comments',
		'revisions' => 'Revisions',
		'page-attributes' => 'Page Attributes',
		'post-formats' => 'Post Formats'
	]);

	return $choices;

});

add_filter('acf/location/rule_match/supports', function($match, $rule, $options) {

	$supported = post_type_supports(get_post_type(), $rule['value']);
	$required = $rule['operator'] === '==';

	return $supported === $required;

}, 10, 3);

*/
