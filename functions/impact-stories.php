<?php

/**
 * return an array of impact stories
 * @return array of impact stories
 */
function get_impact_stories() {

	$impact_stories = get_field('add_stories', 3032);

	foreach ( $impact_stories as &$story ) {

		$story['thumb_url'] = imgix::source('url', $story['image']['url'])
			->options([
				'crop' => 'faces',
				'fit' => 'crop',
				'w' => 460,
				'h' => 460 / (16 / 9),
				'fm' => 'pjpg'
			])
			->url();

		$story['featured_url'] = imgix::source('url', $story['image']['url'])
			->options([
				'crop' => 'faces',
				'fit' => 'crop',
				'w' => 1400,
				'h' => 500,
				'fm' => 'pjpg'
			])
			->url();

		// remove the large array of images
		unset($story['image']);

	}

	return $impact_stories;
	
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
