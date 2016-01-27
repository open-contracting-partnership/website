<?php // functions/content.php

/**
 * return a formatted date from an acf metafield
 * @param  string $acf_field
 * @param  string $date_format
 * @return date
 */
function get_acf_date($acf_field, $date_format) {

	$date = get_field($acf_field);

	$year = substr($date, 0, 4);
	$month = substr($date, 4, 2);
	$day = substr($date, 6, 2);

	return date($date_format, mktime(0, 0, 0, $month, $day, $year));

}

/**
 * convert a string into a slug
 * @param  string $string
 * @return string
 */
function slugify($string) {

	// Remove accents from characters
	$string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);

	// Everything lowercase
	$string = strtolower($string);

	// Replace all non-word characters by dashes
	$string = preg_replace("/\W/", "-", $string);

	// Replace double dashes by single dashes
	$string = preg_replace("/-+/", '-', $string);

	// Trim dashes from the beginning and end of string
	$string = trim($string, '-');

	return $string;
	
}

/**
 * generate WP video embed code based on url
 * @param  string $url
 */
function embed_video($url) {

	// we won't be able to use the [embed] shortcode yet
	// so lets call the shortcode function directly

	$wp_embed = new WP_Embed();
	echo $wp_embed->shortcode(array(), $url);

}

/**
 * extend WP_Query to filter by title
 * @param  string $where
 * @param  object $wp_query
 * @return string
 */
function title_filter($where, &$wp_query) {

	global $wpdb;

	if ( $search_term = $wp_query->get('search_post_title') ) {
		$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
	}

	return $where;

}


 //********
// EXCERPT

$excerpt_length = 35;

/**
 * output custom excerpt length
 * @param integer $length
 */
function _the_excerpt($length = 35) {

	global $excerpt_length;

	$excerpt_length = $length;

	the_excerpt();

}

add_filter('excerpt_length', function($length) {
	global $excerpt_length;
	return $excerpt_length;
}, 999);

add_filter('wp_trim_excerpt', function($excerpt) {
	return str_replace( '[...]', '...', $excerpt );
});


 //************
// META VALUES

/**
 * returns array of post meta values
 * @param  string $key
 * @param  string $type
 * @param  string $status
 * @return array
 */
function get_meta_values($key = '', $type, $status = 'publish') {

	global $wpdb;

	if ( empty($key) ) {
		return FALSE;
	}

	$results = $wpdb->get_results(
		$wpdb->prepare("
			SELECT p.post_title, pm.post_id, pm.meta_value FROM {$wpdb->postmeta} pm
			LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
			WHERE pm.meta_key = '%s'
			AND p.post_status = '%s'
			AND p.post_type = '%s';
		", $key, $status, $type
	));

	$results_array = array();

	foreach ( $results as $key => $value ) {
		$results_array[$value->post_id] = maybe_unserialize($value->meta_value);
	}

	return $results_array;

}


 //*******
// LABELS

/**
 * returns the label for a given post type
 * @param  mixed $post_type
 * @param  boolean $plural
 * @return string
 */
function get_post_type_label($post_type = NULL, $plural = FALSE) {

	$post_type = $post_type === NULL ? get_post_type() : $post_type;
	$post_type_object = get_post_type_object($post_type);
	$label = FALSE;

	if ( $post_type_object ) {

		if ( $plural === TRUE ) {
			$label = $post_type_object->labels->name;
		} else {
			$label = $post_type_object->labels->singular_name;
		}

	}

	return $label;

}

/**
 * echo alias of `get_post_type_label`
 * @param  mixed $post_type
 * @param  boolean $plural
 * @return NULL
 */
function the_post_type_label($post_type = NULL, $plural = FALSE) {
	echo get_post_type_label($post_type, $plural);
}

function get_authors() {

	// set the initial authors array as the normal post author...
	$authors = array(get_author_object());

	// but if multiple authors have been set, completely overwrite this array
	if ( have_rows('authors') ) {

		$authors = array();

		// loop through the rows of data
		while ( have_rows('authors') ) {

			the_row();

			switch ( get_row_layout() ) {

				case 'wordpress_user':
					$authors[] = get_author_object(get_sub_field('user')['ID']);
					break;

				case 'custom_user':
					$authors[] = array('name' => get_sub_field('user'));
					break;

			}

		}

	}

	return $authors;

}

function get_author_object($author_id = NULL) {

	if ( ! $author_id ) {
		$author_id = get_the_author_meta('ID');
	}

	return (object) array(
		'name' => get_the_author_meta('display_name', $author_id),
		'url' => get_author_posts_url($author_id)
	);

}

function the_authors($with_links = FALSE) {

	$link_template = '<a href="%s">%s</a>';

	$authors = get_authors();

	foreach ( $authors as $key => $author ) {

		if ( $with_links && isset($author->url) ) {
			$authors[$key] = sprintf($link_template, $author->url, $author->name);
		} else {
			$authors[$key] = $author->name;
		}

	}

	echo array_multi_implode(', ', ' and ', $authors);

}

function share_links() {

	$url = urlencode(get_permalink());
	$title = wp_title('&raquo;', FALSE, 'right');

	return (object) array(
		'twitter' => "http://twitter.com/home?status={$title} - {$url} via @girlsnotbrides",
		'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$url}",
		'linkedin' => "https://www.linkedin.com/cws/share?url={$url}"
	);

}
