<?php

/**
 * return an array of impact stories
 * @return array of impact stories
 */
function get_impact_stories() {
	return get_field('add_stories', 3032);
}

/**
 * creaye an api endpoint to fetch the report filters
 */
add_action('rest_api_init', function() {

	register_rest_route('ocp/v1', '/impact-stories', array(
		'methods' => 'GET',
		'callback' => 'get_impact_stories',
	));

});
