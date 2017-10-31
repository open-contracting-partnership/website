<?php


/**
 * returns the current language code
 * @return string the language code
 */
function get_language_code() {

	// the default will always be english
	$language = 'en';

	// if another has been set, use that instead
	if ( defined('ICL_LANGUAGE_CODE') && ! empty(ICL_LANGUAGE_CODE) ) {
		$language = ICL_LANGUAGE_CODE;
	}

	return $language;

}

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

/**
 * for non-english pages, attempt to load the original specific page template
 */
add_filter('page_template', function($template) {

	// if the language is english, don't attempt to modify the template
	if ( get_language_code() === 'en' ) {
		return $template;
	}

	$filename = basename($template);

	// if the filename has not defaulted back to page.php, don't proceed further
	if ( $filename !== 'page.php' ) {
		return $template;
	}

	global $post;

	// fetch the english version of this post
	$original_id = icl_object_id($post->ID, $post->post_type, FALSE, 'en');

	// if nothing is returned exit out
	if ( ! $original_id ) {
		return $template;
	}

	// fetch the original post based on the id
	$original_post = get_post($original_id);

	// if nothing is returned exit out
	if ( ! $original_post ) {
		return $template;
	}

	// attempt to locate the originally translated template
	$new_template = locate_template([
		'page-' . $original_post->post_name . '.php',
		'page.php'
	]);

	// if the new template is not falsey, we can finally use this as the alternative
	if ( $new_template ) {
		return $new_template;
	}

	// … otherwise return the original
	return $template;

});
