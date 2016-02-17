<?php // functions/shortcodes.php

add_shortcode('section', function($atts, $content = null) {
	return '<p class="section__title" id="' . sanitize_title($content) . '"><span class="button">' . strip_tags($content) . '</span></p>';
});

function get_sections() {

	global $post;
	$pattern = get_shortcode_regex();
	preg_match_all('/'.$pattern.'/s', $post->post_content, $matches, PREG_SET_ORDER);

	$sections = array();

	if ( is_array($matches) ) {

		foreach ( $matches as $match ) {

			if ( $match[2] === 'section' ) {
				$sections[sanitize_title($match[5])] = strip_tags($match[5]);
			}

		}

	}

	return $sections;

}
