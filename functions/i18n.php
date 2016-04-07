<?php

if ( ! function_exists('pll_e') ) {

	function pll_e($string) {
		echo $string;
	}

}

if ( ! function_exists('pll__') ) {

	function pll__($string) {
		return $string;
	}

}

// unset translation support for posts
// only pages will be translatable

add_filter('pll_get_post_types', function($types) {
	unset ($types['post']);
	return $types;
});


 //**************************
// WPML TRANSLATION HANDLING

// WPML doesn't play very well with custom queries and fetching a mix of
// languages, as such filter query_loop to allow for this mix

$current_lang = '';

add_action('query_loop_pre_query', function() {

	global $sitepress, $current_lang;

	// only continue to filter if the WPML plugin is enabled
	if ( isset($sitepress) ) {

		$current_lang = $sitepress->get_current_language();
		$default_lang = $sitepress->get_default_language();
		$diff_lang = $current_lang !== $default_lang;

		if ( $diff_lang ) {
			$sitepress->switch_lang($default_lang);
		}

	}

});

add_filter('query_loop_post_query', function($posts) {

	global $sitepress, $current_lang;

	$translated_posts = array();

	// only continue to filter if the WPML plugin is enabled
	if ( isset($sitepress) ) {

		$default_lang = $sitepress->get_default_language();
		$diff_lang = $current_lang !== $default_lang;

		if ( $diff_lang ) {

			// loop through the default posts, translating any posts back
			// to the current language where possible

			foreach ( $posts as $post ) {

				$translated_id = icl_object_id($post->ID, $post->post_type, FALSE, $current_lang);

				if ( $translated_id ) {
					$translated_posts[] = get_post($translated_id);
				} else {
					$translated_posts[] = $post;
				}


			}

			$posts = $translated_posts;

			// revert the language back to the original
			$sitepress->switch_lang($current_lang);

		}

	}

	return $posts;

});
