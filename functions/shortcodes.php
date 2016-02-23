<?php // functions/shortcodes.php


 //********
// SECTION

add_shortcode('section', function($atts, $content = null) {
	return '<h3 class="section__title" id="' . sanitize_title($content) . '">' . strip_tags($content) . '</h3>';
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


 //*****
// PULL


add_shortcode('pull', function($atts, $content = null) {

	$find = ['<div class="pull"></p>', '<p></div>'];
	$replace = ['<div class="pull">', '</div>'];

	// var_Dump($content);
	return str_replace($find, $replace, '<div class="pull">' . trim(wpautop($content)) . '</div>');

});
